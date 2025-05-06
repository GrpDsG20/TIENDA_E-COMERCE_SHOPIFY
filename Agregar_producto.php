<?php

session_start();

// Verificar si el usuario está autenticado y es admin
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['rol'] !== 'admin') {
    // Redirigir al login si no está autenticado o no es admin
    header('Location: login.php');
    exit(); // Detener la ejecución del script
}


include 'conexion.php';

// Detectar si estamos en modo edición
$modoEdicion = isset($_GET['id']);
$producto = null;
$colores = [];

if ($modoEdicion) {
    $idProducto = $_GET['id'];
    $query = "SELECT * FROM productos WHERE id = $idProducto";
    $resultado = $conn->query($query);
    $producto = $resultado->fetch_assoc();

    // Obtener los colores guardados si existen
    if (!empty($producto['colores'])) {
        $colores = explode(',', $producto['colores']); // Separar colores por comas
    }
}

// Obtener categorías de la base de datos
$categorias = $conn->query("SELECT * FROM categorias");
$categoria_secundaria = $conn->query("SELECT * FROM categoria_secundaria");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="style/agregar_producto.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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


    <h2><?php echo $modoEdicion ? 'Actualizar Producto' : 'Registrar Producto'; ?></h2>
    <form action="<?= $modoEdicion ? 'actualizar_producto.php' : 'procesar.php' ?>" method="POST" enctype="multipart/form-data">
        <?php if ($modoEdicion): ?>
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
        <?php endif; ?>



        <div class="mb-3">
            <label class="form-label">Nombre del Producto</label>
            <input type="text" name="nombre" class="form-control" value="<?= $producto['nombre'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" required><?= $producto['descripcion'] ?? '' ?></textarea>
        </div>



        <div class="mb-3">
            <label class="form-label">Colores (opcional)</label>
            <div id="selectores-colores" style="display: flex; gap: 10px;">
                <input type="color" name="color_1" class="form-control color-input" value="<?= isset($colores[0]) ? $colores[0] : '#E6E6E6'; ?>">
                <input type="color" name="color_2" class="form-control color-input" value="<?= isset($colores[1]) ? $colores[1] : '#E6E6E6'; ?>">
                <input type="color" name="color_3" class="form-control color-input" value="<?= isset($colores[2]) ? $colores[2] : '#E6E6E6'; ?>">
                <input type="color" name="color_4" class="form-control color-input" value="<?= isset($colores[3]) ? $colores[3] : '#E6E6E6'; ?>">
                <input type="color" name="color_5" class="form-control color-input" value="<?= isset($colores[4]) ? $colores[4] : '#E6E6E6'; ?>">
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label">Precio Original</label>
            <input type="number" step="0.01" name="precio_original" class="form-control" id="precio_original" value="<?= $producto['precio_original'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descuento (%)</label>
            <input type="number" name="descuento" class="form-control" id="descuento" value="<?= $producto['descuento'] ?? '' ?>" required oninput="calcularPrecio()">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio con Descuento</label>
            <input type="number" step="0.01" name="precio" class="form-control" id="precio" value="<?= $producto['precio'] ?? '' ?>" readonly style="pointer-events: none;background-color: #f0f0f0;">
        </div>
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= $producto['stock'] ?? '' ?>" required>

        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                <?php while ($categoria = $categorias->fetch_assoc()): ?>
                    <option value="<?= $categoria['id'] ?>" <?= ($producto['categoria_id'] ?? '') == $categoria['id'] ? 'selected' : '' ?>><?= $categoria['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría Secundaria</label>
            <select name="categoria_secundaria" class="form-control">
                <option value="">Seleccione una categoría secundaria</option>
                <?php while ($categoria = $categoria_secundaria->fetch_assoc()): ?>
                    <option value="<?= $categoria['id'] ?>" <?= ($producto['categoria_id'] ?? '') == $categoria['id'] ? 'selected' : '' ?>><?= $categoria['nombre'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen Principal</label>
            <input type="file" name="imagen_principal" class="form-control" <?php echo $modoEdicion ? '' : 'required'; ?>>
            <?php if ($modoEdicion && !empty($producto['imagen_principal'])): ?>
                <small class="text-muted">Imagen actual: <?php echo basename($producto['imagen_principal']); ?></small>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Imágenes Adicionales (Máx. 5)</label>
            <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">
            <?php echo $modoEdicion ? 'Actualizar' : 'Registrar'; ?>
        </button>
    </form>


    <?php include 'includes/footer.php'; ?>

    <script src="JS/agregar_producto.js"></script>
</body>

</html>