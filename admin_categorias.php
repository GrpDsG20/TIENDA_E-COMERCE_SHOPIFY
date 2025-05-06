<?php

session_start();

// Verificar si el usuario está autenticado y es admin
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['rol'] !== 'admin') {
    // Redirigir al login si no está autenticado o no es admin
    header('Location: login.php');
    exit();
}

include 'conexion.php';

// Agregar o Actualizar Categoría Principal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre_categoria'])) {
    $nombre = trim($_POST['nombre_categoria']);
    $id = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : null;

    if (!empty($nombre)) {
        if ($id) { // Si hay ID, se actualiza
            $stmt = $conn->prepare("UPDATE categorias SET nombre = ? WHERE id = ?");
            $stmt->bind_param("si", $nombre, $id);
            $mensaje = "Categoría principal actualizada correctamente.";
        } else { // Si no hay ID, se agrega
            $stmt = $conn->prepare("INSERT INTO categorias (nombre) VALUES (?)");
            $stmt->bind_param("s", $nombre);
            $mensaje = "Categoría principal agregada correctamente.";
        }

        if ($stmt->execute()) {
            echo "<p style='color: green;'>$mensaje</p>";
        } else {
            echo "<p style='color: red;'>Error al procesar la categoría principal.</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color: red;'>El nombre de la categoría principal no puede estar vacío.</p>";
    }
}

// Agregar o Actualizar Categoría Secundaria
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre_categoria_secundaria'])) {
    $nombre = trim($_POST['nombre_categoria_secundaria']);
    $id = isset($_POST['id_categoria_secundaria']) ? $_POST['id_categoria_secundaria'] : null;

    if (!empty($nombre)) {
        if ($id) { // Si hay ID, se actualiza
            $stmt = $conn->prepare("UPDATE categoria_secundaria SET nombre = ? WHERE id = ?");
            $stmt->bind_param("si", $nombre, $id);
            $mensaje = "Categoría secundaria actualizada correctamente.";
        } else { // Si no hay ID, se agrega
            $stmt = $conn->prepare("INSERT INTO categoria_secundaria (nombre) VALUES (?)");
            $stmt->bind_param("s", $nombre);
            $mensaje = "Categoría secundaria agregada correctamente.";
        }

        if ($stmt->execute()) {
            echo "<p style='color: green;'>$mensaje</p>";
        } else {
            echo "<p style='color: red;'>Error al procesar la categoría secundaria.</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color: red;'>El nombre de la categoría secundaria no puede estar vacío.</p>";
    }
}

// Eliminar Categoría Principal o Secundaria
if (isset($_GET['eliminar']) && isset($_GET['tipo'])) {
    $id = $_GET['eliminar'];
    $tipo = $_GET['tipo'];

    $tabla = $tipo == 'principal' ? 'categorias' : 'categoria_secundaria';
    $stmt = $conn->prepare("DELETE FROM $tabla WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Categoría eliminada correctamente.</p>";
    } else {
        echo "<p style='color: red;'>Error al eliminar la categoría.</p>";
    }
    $stmt->close();
}

// Obtener todas las categorías principales y secundarias
$resultado_principal = $conn->query("SELECT * FROM categorias ORDER BY nombre");
$resultado_secundaria = $conn->query("SELECT * FROM categoria_secundaria ORDER BY nombre");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="style/admin_categorias.css">
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


    <div class="contenedor-categorias">
        <!-- Categoría Principal -->
        <div class="seccion">
            <h2>Nueva Categoría Principal</h2>
            <form method="POST" class="form-category">
                <input type="hidden" name="id_categoria" value="<?= isset($_GET['editar']) && $_GET['tipo'] == 'principal' ? $_GET['editar'] : '' ?>">
                <input type="text" name="nombre_categoria" placeholder="Nombre de la categoría principal" value="<?= isset($_GET['editar']) && $_GET['tipo'] == 'principal' ? $_GET['nombre'] : '' ?>" required>
                <button type="submit"><?= isset($_GET['editar']) && $_GET['tipo'] == 'principal' ? 'Actualizar' : 'Agregar' ?></button>
            </form>



            <ul>
                <?php while ($categoria = $resultado_principal->fetch_assoc()): ?>
                    <li>
                        <?= $categoria['nombre'] ?>
                        <div class="icons-buttons">
                            <a class="edit" href="?editar=<?= $categoria['id'] ?>&tipo=principal&nombre=<?= $categoria['nombre'] ?>"><svg enable-background="new 0 0 64 64" height="64px" id="Layer_1" version="1.1" viewBox="0 0 64 64" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g>
                                        <path d="M55.736,13.636l-4.368-4.362c-0.451-0.451-1.044-0.677-1.636-0.677c-0.592,0-1.184,0.225-1.635,0.676l-3.494,3.484   l7.639,7.626l3.494-3.483C56.639,15.998,56.639,14.535,55.736,13.636z" />
                                        <polygon points="21.922,35.396 29.562,43.023 50.607,22.017 42.967,14.39  " />
                                        <polygon points="20.273,37.028 18.642,46.28 27.913,44.654  " />
                                        <path d="M41.393,50.403H12.587V21.597h20.329l5.01-5H10.82c-1.779,0-3.234,1.455-3.234,3.234v32.339   c0,1.779,1.455,3.234,3.234,3.234h32.339c1.779,0,3.234-1.455,3.234-3.234V29.049l-5,4.991V50.403z" />
                                    </g>
                                </svg></a>
                            <a class="delete" href="?eliminar=<?= $categoria['id'] ?>&tipo=principal" onclick="return confirm('¿Deseas eliminar esta categoría principal?')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="100%" height="100%" viewBox="0 0 64 64" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                    <path d="M27,3L9,3C7.896,3 7,3.896 7,5C7,6.104 7.896,7 9,7L55,7C56.104,7 57,6.104 57,5C57,3.896 56.104,3 55,3L38,3C38,1.896 37.104,1 36,1L29,1C27.896,1 27,1.896 27,3Z" />
                                    <path d="M56.981,11.277C57.061,10.704 56.889,10.124 56.509,9.687C56.129,9.251 55.579,9 55,9L9,9C8.421,9 7.871,9.251 7.491,9.687C7.111,10.124 6.939,10.704 7.019,11.277L14.019,61.277C14.158,62.265 15.003,63 16,63L48,63C48.997,63 49.842,62.265 49.981,61.277L56.981,11.277ZM16.019,18.275L21.019,54.275C21.171,55.368 22.182,56.133 23.275,55.981C24.368,55.829 25.133,54.818 24.981,53.725L19.981,17.725C19.829,16.632 18.818,15.867 17.725,16.019C16.632,16.171 15.867,17.182 16.019,18.275ZM44.019,17.725L39.019,53.725C38.867,54.818 39.632,55.829 40.725,55.981C41.818,56.133 42.829,55.368 42.981,54.275L47.981,18.275C48.133,17.182 47.368,16.171 46.275,16.019C45.182,15.867 44.171,16.632 44.019,17.725ZM30,18L30,54C30,55.104 30.896,56 32,56C33.104,56 34,55.104 34,54L34,18C34,16.896 33.104,16 32,16C30.896,16 30,16.896 30,18Z" />
                                </svg></a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <!-- Categoría Secundaria -->
        <div class="seccion">
            <h2>Nueva Categoría Secundaria</h2>
            <form method="POST" class="form-category">
                <input type="hidden" name="id_categoria_secundaria" value="<?= isset($_GET['editar']) && $_GET['tipo'] == 'secundaria' ? $_GET['editar'] : '' ?>">
                <input type="text" name="nombre_categoria_secundaria" placeholder="Nombre de la categoría secundaria" value="<?= isset($_GET['editar']) && $_GET['tipo'] == 'secundaria' ? $_GET['nombre'] : '' ?>" required>
                <button type="submit"><?= isset($_GET['editar']) && $_GET['tipo'] == 'secundaria' ? 'Actualizar' : 'Agregar' ?></button>
            </form>
            <ul>
                <?php while ($categoria = $resultado_secundaria->fetch_assoc()): ?>
                    <li>
                        <?= $categoria['nombre'] ?>
                        <div class="icons-buttons">
                            <a class="edit" href="?editar=<?= $categoria['id'] ?>&tipo=secundaria&nombre=<?= $categoria['nombre'] ?>"><svg enable-background="new 0 0 64 64" height="64px" id="Layer_1" version="1.1" viewBox="0 0 64 64" width="64px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g>
                                        <path d="M55.736,13.636l-4.368-4.362c-0.451-0.451-1.044-0.677-1.636-0.677c-0.592,0-1.184,0.225-1.635,0.676l-3.494,3.484   l7.639,7.626l3.494-3.483C56.639,15.998,56.639,14.535,55.736,13.636z" />
                                        <polygon points="21.922,35.396 29.562,43.023 50.607,22.017 42.967,14.39  " />
                                        <polygon points="20.273,37.028 18.642,46.28 27.913,44.654  " />
                                        <path d="M41.393,50.403H12.587V21.597h20.329l5.01-5H10.82c-1.779,0-3.234,1.455-3.234,3.234v32.339   c0,1.779,1.455,3.234,3.234,3.234h32.339c1.779,0,3.234-1.455,3.234-3.234V29.049l-5,4.991V50.403z" />
                                    </g>
                                </svg></a>
                            <a href="?eliminar=<?= $categoria['id'] ?>&tipo=secundaria" onclick="return confirm('¿Deseas eliminar esta categoría secundaria?')" class="delete"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="100%" height="100%" viewBox="0 0 64 64" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                                    <path d="M27,3L9,3C7.896,3 7,3.896 7,5C7,6.104 7.896,7 9,7L55,7C56.104,7 57,6.104 57,5C57,3.896 56.104,3 55,3L38,3C38,1.896 37.104,1 36,1L29,1C27.896,1 27,1.896 27,3Z" />
                                    <path d="M56.981,11.277C57.061,10.704 56.889,10.124 56.509,9.687C56.129,9.251 55.579,9 55,9L9,9C8.421,9 7.871,9.251 7.491,9.687C7.111,10.124 6.939,10.704 7.019,11.277L14.019,61.277C14.158,62.265 15.003,63 16,63L48,63C48.997,63 49.842,62.265 49.981,61.277L56.981,11.277ZM16.019,18.275L21.019,54.275C21.171,55.368 22.182,56.133 23.275,55.981C24.368,55.829 25.133,54.818 24.981,53.725L19.981,17.725C19.829,16.632 18.818,15.867 17.725,16.019C16.632,16.171 15.867,17.182 16.019,18.275ZM44.019,17.725L39.019,53.725C38.867,54.818 39.632,55.829 40.725,55.981C41.818,56.133 42.829,55.368 42.981,54.275L47.981,18.275C48.133,17.182 47.368,16.171 46.275,16.019C45.182,15.867 44.171,16.632 44.019,17.725ZM30,18L30,54C30,55.104 30.896,56 32,56C33.104,56 34,55.104 34,54L34,18C34,16.896 33.104,16 32,16C30.896,16 30,16.896 30,18Z" />
                                </svg></a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
    <br><br>


    <?php include 'includes/footer.php'; ?>
</body>

</html>

<?php $conn->close(); ?>