<?php
include 'conexion.php'; // Conexión a la BD

$mensaje_error = '';
$mostrar_carga = false;

// Limitar intentos de inicio de sesión
session_start();
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar entradas
    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);

    if (empty($usuario) || empty($contraseña)) {
        $mensaje_error = "Por favor, complete todos los campos.";
    } elseif ($_SESSION['intentos'] >= 3) {
        $mensaje_error = "Demasiados intentos fallidos. Intente más tarde.";
    } else {
        // Consulta SQL segura
        $query = "SELECT id, contraseña, rol FROM usuarios WHERE usuario = ?"; // Asegúrate de seleccionar el rol
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($contraseña, $fila['contraseña'])) {
                // Restablecer intentos fallidos
                $_SESSION['intentos'] = 0;

                // Establecer variables de sesión
                $_SESSION['autenticado'] = true;
                $_SESSION['rol'] = $fila['rol']; // Guardar el rol del usuario
                $_SESSION['usuario'] = $usuario; // Guardar el nombre de usuario en la sesión

                // Actualizar la última conexión en la base de datos
                $stmt_update = $conn->prepare("UPDATE usuarios SET ultima_conexion = NOW() WHERE usuario = ?");
                $stmt_update->bind_param("s", $usuario);
                if ($stmt_update->execute()) {
                    error_log("Última conexión actualizada para el usuario: " . $usuario);
                } else {
                    error_log("Error al actualizar la última conexión para el usuario: " . $usuario);
                }
                $stmt_update->close();

                // Redirección segura
                $mostrar_carga = true;
                if ($fila['rol'] === 'admin') {
                    echo '<script>
                            setTimeout(() => {
                                window.location.href = "dashboard.php";
                            }, 3000);
                          </script>';
                } elseif ($fila['rol'] === 'ventas') {
                    echo '<script>
                            setTimeout(() => {
                                window.location.href = "panel.php";
                            }, 3000);
                          </script>';
                }
            } else {
                $_SESSION['intentos']++;
                $mensaje_error = "Usuario o contraseña incorrectos.";
            }
        } else {
            $_SESSION['intentos']++;
            $mensaje_error = "Usuario o contraseña incorrectos.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/login.css">
</head>

<body>
    <?php if ($mostrar_carga): ?>
        <div class="loading-overlay">
            <div class="spinner"></div>
        </div>
    <?php endif; ?>

    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="" class="form_login">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contraseña" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
            <?php if (!empty($mensaje_error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($mensaje_error); ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>