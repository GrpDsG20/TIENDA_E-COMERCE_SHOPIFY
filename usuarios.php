<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está autenticado y es admin
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['rol'] !== 'admin') {
    // Redirigir al login si no está autenticado o no es admin
    header('Location: login.php');
    exit();
}

// Agregar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario'])) {
    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);
    $rol = $_POST['rol'];

    // Validar usuario (solo letras, números y guion bajo, entre 5 y 20 caracteres)
    if (!preg_match('/^[a-zA-Z0-9_]{5,20}$/', $usuario)) {
        echo "<script>alert('El nombre de usuario solo puede contener letras, números y guion bajo (5-20 caracteres).');</script>";
    } else {
        // Verificar si el usuario ya existe
        $stmt_verificar = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt_verificar->bind_param("s", $usuario);
        $stmt_verificar->execute();
        $resultado_verificar = $stmt_verificar->get_result();

        if ($resultado_verificar->num_rows > 0) {
            echo "<script>alert('El nombre de usuario ya está en uso. Por favor, elige otro.');</script>";
        } elseif (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $contraseña)) {
            $contraseña = password_hash($contraseña, PASSWORD_BCRYPT);

            // Insertar nuevo usuario con la fecha de creación
            $stmt_insert = $conn->prepare("INSERT INTO usuarios (usuario, contraseña, rol, ultima_conexion) VALUES (?, ?, ?, NOW())");
            $stmt_insert->bind_param("sss", $usuario, $contraseña, $rol);

            if ($stmt_insert->execute()) {
                echo "<script>alert('Usuario agregado correctamente.'); window.location.href='usuarios.php';</script>";
            } else {
                echo "<script>alert('Error al agregar usuario.');</script>";
            }

            $stmt_insert->close();
        } else {
            echo "<p style='color: red;'>La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas, números y caracteres especiales.</p>";
        }
        $stmt_verificar->close();
    }
}

// Eliminar usuario
if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $stmt_delete = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt_delete->bind_param("i", $id);
    if ($stmt_delete->execute()) {
        echo "<script>alert('Usuario eliminado correctamente.'); window.location.href='usuarios.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar usuario.');</script>";
    }
    $stmt_delete->close();
}

// Obtener usuarios
$resultado = $conn->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuarios</title>
    <link rel="stylesheet" href="style/usuarios.css">
</head>

<body>
    <?php include 'includes/navbar_admin.php'; ?>

    <br><br><br>
    <div class="volver-dashboard">
        <a href="dashboard.php"> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="612px" height="612px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
                <path d="M497.25,497.25c0,21.114-17.117,38.25-38.25,38.25H76.5c-21.133,0-38.25-17.136-38.25-38.25v-382.5
				c0-21.133,17.117-38.25,38.25-38.25H459c21.133,0,38.25,17.117,38.25,38.25v57.375h38.25V114.75c0-42.247-34.253-76.5-76.5-76.5
				H76.5C34.253,38.25,0,72.503,0,114.75v382.5c0,42.247,34.253,76.5,76.5,76.5H459c42.247,0,76.5-34.253,76.5-76.5v-57.375h-38.25
				V497.25z M592.875,286.875H180.043l100.272-100.272c7.478-7.458,7.478-19.584,0-27.042c-7.478-7.478-19.584-7.478-27.042,0
				L121.329,291.522c-3.997,3.978-5.699,9.256-5.432,14.478c-0.268,5.221,1.435,10.5,5.413,14.478l131.943,131.943
				c7.458,7.478,19.584,7.478,27.042,0c7.478-7.459,7.478-19.584,0-27.043L180.043,325.125h412.832
				c10.557,0,19.125-8.568,19.125-19.125C612,295.443,603.432,286.875,592.875,286.875z" />
            </svg>
            Volver al Dashboard</a>
    </div>


    <div class="contenedor">
        <h2>Panel de Usuarios</h2>
        <div class="form-agregar">
            <form method="POST" action="usuarios.php">
                <input type="text" name="usuario" placeholder="Nombre de usuario" required>
                <input type="password" name="contraseña" placeholder="Contraseña" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" title="Debe tener al menos 8 caracteres, incluir mayúscula, minúscula, número y carácter especial." required>
                <select name="rol" required>
                    <option value="" disabled selected>Seleccionar rol</option>
                    <option value="admin">Admin</option>
                    <option value="ventas">Ventas</option>
                </select>
                <button type="submit">Agregar Usuario</button>
            </form>
        </div>

        <table>
            <tr>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Última Conexión</th>
                <th>Acciones</th>
            </tr>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['usuario']; ?></td>
                    <td><?php echo $fila['rol']; ?></td>
                    <td><?php echo $fila['ultima_conexion'] ? $fila['ultima_conexion'] : 'Sin conexión'; ?></td>
                    <td><a href="usuarios.php?eliminar=<?php echo $fila['id']; ?>" class="btn-eliminar" onclick="return confirmarEliminacion()">Eliminar</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    <script>
        // Función para confirmar la eliminación
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este usuario?");
        }
    </script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>

<?php
$conn->close();
?>