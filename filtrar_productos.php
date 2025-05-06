<?php
include 'conexion.php'; // Conectar a la BD

// Obtener los parámetros de la URL (si existen)
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$category = isset($_GET['category']) ? intval($_GET['category']) : 0;
$price = isset($_GET['price']) ? intval($_GET['price']) : 1000;
$popularity = isset($_GET['popularity']) ? intval($_GET['popularity']) : 0;

// Construir la consulta base
$sql = "SELECT id, nombre, precio, precio_original, descuento, imagen_principal 
        FROM productos 
        WHERE precio <= $price";

// Filtrar por búsqueda (si se proporciona un término de búsqueda)
if (!empty($search)) {
    $sql .= " AND nombre LIKE '%$search%'";
}

// Filtrar por categoría principal (si se proporciona un ID de categoría)
if ($category > 0) {
    $sql .= " AND categoria_id = $category";
}

// Filtrar por popularidad (si se proporciona un ID de popularidad)
if ($popularity > 0) {
    $sql .= " AND categoria_secundaria_id = $popularity"; 
}

// Ordenar por popularidad si se selecciona
if ($popularity == "popular") {
    $sql .= " ORDER BY visitas DESC";
} elseif ($popularity == "sold") {
    $sql .= " ORDER BY ventas DESC";
} elseif ($popularity == "offers") {
    $sql .= " ORDER BY descuento DESC";
}

// Ejecutar la consulta
$resultado = $conn->query($sql);

// Verificar si hay productos disponibles
if ($resultado->num_rows > 0) {
    // Mostrar los productos filtrados
    while ($producto = $resultado->fetch_assoc()):
?>
        <a href="producto.php?id=<?= $producto['id'] ?>" class="producto">
            <img src="<?= $producto['imagen_principal'] ?>" alt="<?= $producto['nombre'] ?>">
            <p class="nombre"><?= $producto['nombre'] ?></p>
            <p class="precio">
                S/<?= number_format($producto['precio'], 2) ?>
                <?php if ($producto['descuento'] > 0): ?>
                    <s>S/<?= number_format($producto['precio_original'], 2) ?></s>
                <?php endif; ?>
            </p>
            <?php if ($producto['descuento'] > 0): ?>
                <p class="descuento"><?= $producto['descuento'] ?>% <span class="tiempo-limitado">de descuento</span></p>
            <?php else: ?>
                <br> <br>
            <?php endif; ?>

            <button onclick="agregarAlCarrito(event, '<?= $producto['nombre'] ?>', '<?= $producto['imagen_principal'] ?>', <?= $producto['precio'] ?>, <?= $producto['precio_original'] ?>)" class="agregar-carrito">Agregar al carrito</button>
        </a>
<?php
    endwhile;
} else {
    echo "<p>No se encontraron productos.</p>";
}

$conn->close();
?>