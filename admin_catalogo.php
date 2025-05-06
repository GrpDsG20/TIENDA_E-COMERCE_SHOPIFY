<?php
session_start();

// Verificar si el usuario está autenticado y es admin
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true || $_SESSION['rol'] !== 'admin') {
    // Redirigir al login si no está autenticado o no es admin
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 40px 20px 10px 20px;
        width: 80%;
        margin: auto;
        font-family: 'Poppins', sans-serif;
        color: #000;
        display: flex;
        gap: 10px;
    }

    .btn-agregar {
        background-color: #FF6F00;
        font-family: 'Poppins', sans-serif;
        color: #fff;
        padding: 10px 25px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1rem;
    }

    .btn-agregar:hover {
        background-color: #e65c00;
    }

    .buscador {
        padding: 8px;
        flex-grow: 1;
        border: 1px solid #ccc;
        outline: none;
        border-radius: 5px;
    }

    .dashboard-header svg {
        fill: #fff;
        width: 24px;
        height: 24px;
    }

    .eliminar-producto {
        background-color: rgb(228, 45, 45);
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 5px;
        font-size: 0.8rem;
        cursor: pointer;
        width: 100%;
        font-family: 'Poppins', sans-serif;
        margin-top: 10px;
        transition: background 0.3s;
    }

    .eliminar-producto:hover {
        background-color: rgb(156, 42, 42);

    }

    @media (max-width: 1400px) {
        .dashboard-header {
            width: 95%;
        }

    }

    @media (max-width: 768px) {

        .eliminar-producto {
            width: 90%;
        }
    }

    @media (max-width: 540px) {
        .dashboard-header {
            flex-direction: column;
            align-items: stretch;
            padding: 15px;
        }

        .btn-agregar {
            width: 100%;
            text-align: center;
            order: 2;
        }

    }
</style>

<body>
    <?php include 'includes/navbar_admin.php'; ?>
    <br><br><br><br>
    <div class="dashboard-header">
        <a href="agregar_producto.php" class="btn-agregar">
            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <line x1="16" x2="16" y1="7" y2="25" stroke="white" stroke-width="2" stroke-linecap="round" />
                <line x1="7" x2="25" y1="16" y2="16" stroke="white" stroke-width="2" stroke-linecap="round" />
            </svg>
            Agregar Producto
        </a>
        <input type="text" id="buscador" placeholder="Buscar producto..." class="buscador">
    </div>

    <?php
    include 'conexion.php';
    $sql = "SELECT id, nombre, precio, precio_original, descuento, imagen_principal FROM productos";
    $resultado = $conn->query($sql);
    ?>

    <section class="productos">
        <?php while ($producto = $resultado->fetch_assoc()): ?>
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
                <?php endif; ?>
                <button class="agregar-carrito" data-id="<?= $producto['id'] ?>">Editar</button>
                <button class="eliminar-producto" data-id="<?= $producto['id'] ?>">Eliminar</button>

            </a>
        <?php endwhile; ?>
    </section>


    <?php $conn->close(); ?>
    <br>

    <?php include 'includes/footer.php'; ?>

    <script src="JS/admin_catalogo.js"></script>
</body>

</html>