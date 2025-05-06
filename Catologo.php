<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="style/catalogo.css">
</head>

<body>

    <?php include 'includes/navbar.php'; ?>
    <?php
    include 'conexion.php';

    $query = "SELECT id, nombre FROM categorias";
    $result = $conn->query($query);

    $query_popularity = "SELECT id, nombre FROM categoria_secundaria";
    $result_popularity = $conn->query($query_popularity);
    ?>

    <br>
    <div class="catalog-section">

        <!-- Filtros Avanzados -->
        <div class="filters-container">
            <h3>Filtros Avanzados</h3>

            <div class="filter-labels">
                <span>Categoría</span>
                <span>Popularidad</span>
                <span>Precio</span>
            </div>

            <div class="filters">
                <div class="filter-item">
                    <select id="category-filter">
                        <option value="">Todas las categorías</option>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nombre'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="filter-item">
                    <select id="popularity-filter">
                        <option value="">Selecciona</option>
                        <?php while ($row_popularity = $result_popularity->fetch_assoc()) { ?>
                            <option value="<?= $row_popularity['id'] ?>"><?= $row_popularity['nombre'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="filter-item-m">
                    <input type="range" min="2" max="1000" step="10" id="price-slider" value="500">
                    <label>Precio: <span id="price-value"></span></label>
                </div>

            </div>
        </div>
    </div>

    <section id="productos" class="productos"></section>


    <?php $conn->close(); ?>

    <?php include 'includes/carrito.php'; ?>
    <?php include 'includes/footer.php'; ?>


    <script src="JS/catalogo.js"></script>
</body>

</html>