<?php
include 'conexion.php'; // Conexión a la BD

// Obtener el ID del producto desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar el producto, incluyendo los colores
$sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.precio_original, p.descuento, p.imagen_principal, p.colores 
        FROM productos p WHERE p.id = $id";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();
} else {
    echo "Producto no encontrado";
    exit;
}

// Consultar imágenes de referencia
$sql_imagenes = "SELECT imagen FROM imagenes_productos WHERE producto_id = $id";
$resultado_imagenes = $conn->query($sql_imagenes);

$imagenes = [];
while ($fila = $resultado_imagenes->fetch_assoc()) {
    $imagenes[] = $fila['imagen'];
}

// Consultar productos relacionados
$sql_relacionados = "SELECT id, nombre, precio, imagen_principal, descuento, precio_original
                     FROM productos 
                     WHERE categoria_id = (SELECT categoria_id FROM productos WHERE id = $id) 
                     AND id != $id LIMIT 4";
$resultado_relacionados = $conn->query($sql_relacionados);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $producto['nombre'] ?></title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }


        .producto-detalle {
            display: flex;
            gap: 20px;
            padding: 20px;
            width: 80%;
            margin: auto;
            overflow: hidden;
            flex-wrap: wrap;
        }

        .producto-detalle svg {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            vertical-align: middle;

        }

        .imagenes {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .imagen-principal {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .imagenes-secundarias {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding: 5px;
        }

        .imagenes-secundarias img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .imagenes-secundarias img:hover {
            transform: scale(1.1);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        }

        .info {
            display: flex;
            flex-direction: column;
            gap: 10px;
            color: #000;
            padding: 0 50px;
            border-radius: 10px;
            flex: 1;
        }

        .info h1 {
            font-size: 1.2rem;
            padding-top: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .descripcion {
            font-size: 16px;
            color: #000;
            line-height: 1.6;
            font-family:sans-serif;
        }

        .precio_producto {
            font-size: 1.2rem;
            font-weight: bold;
            color: #FF6F00;
            font-family: 'Poppins', sans-serif;
        }

        .agregar-carrito_producto {
            padding: 10px 20px;
            background-color: #FF6F00;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .envio-gratis_header {
            background-color: #FEEFE1;
            font-family: 'Poppins', sans-serif;
            padding: 10px;
            border-radius: 8px;
        }

        .envio-gratis a {
            color: #0a8800;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        .agregar-carrito_producto:hover {
            background-color: #e65c00;
        }

        .precio_producto s {
            font-size: 0.9rem;
            color: #888;
            margin-left: 5px;
            font-family: 'Poppins', sans-serif;
        }
        .color-circular {
    display: inline-block;
    width: 22px;
    height: 22px;
    border-radius: 50%; /* Hace el color circular */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); 
    margin-left: 5px;
    vertical-align: middle;
    
}
.titulo-colores {
    font-family: 'Poppins', sans-serif;
}


        @media (max-width: 1400px) {
            .producto-detalle {
            width: 95%;

        }

}


@media (max-width: 768px) {
    .producto-detalle {
        flex-direction: column;
        align-items: center;
        padding: 5px;
    }
    .info {
        padding: 0 20px;
       
    }
    .productos-relacionados h2 {
            width: 95%;
            text-align: center;
            font-size: 1.2rem !important;
        }
}

        .productos-relacionados h2 {
            width: 75%;
            padding: 30px 0 10px 0;
            margin: auto;
            font-size: 2rem;
            font-family: 'Poppins', sans-serif;
        }

        .productos {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            width: 80%;
            margin: 20px auto;
            gap: 15px;
            padding: 20px;
        }

        .producto {
            display: block;
            text-decoration: none;
            color: inherit;
            background: #fff;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .producto:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .producto .nombre {
            font-size: 0.9rem;
            font-weight: bold;
            color: #000;
            white-space: normal;
            text-transform: capitalize;
            word-wrap: break-word;
            overflow-wrap: break-word;
            padding: 15px 5px 0 5px;
            font-family: 'Poppins', sans-serif;

        }


        .producto img {
            width: 100%;
            border-radius: 8px;
        }

        .precio {
            font-size: 1rem;
            font-weight: bold;
            color: #FF6F00;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .precio s {
            font-size: 0.8rem;
            color: #888;
            margin-left: 5px;
            font-family: 'Poppins', sans-serif;

        }

        .descuento {
            font-size: 0.8rem;
            color: #000;
            font-weight: bold;
            padding-top: 5px;
            font-family: 'Poppins', sans-serif;

        }


        .agregar-carrito {
            background-color: #FF6F00;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            font-family: 'Poppins', sans-serif;
            transition: background 0.3s;
        }

        .agregar-carrito:hover {
            background-color: #e65c00;
        }


        @media (max-width: 1400px) {
            .productos {
                width: 95%;
            }

        }

        /* Responsivo: 3 columnas en tablets */
        @media (max-width: 1024px) {
            .productos {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Responsivo: 2 columnas en celulares */
        @media (max-width: 768px) {
            .productos {
                grid-template-columns: repeat(2, 1fr);
                width: 100%;
                padding: 0;
                gap: 5px;

            }

            .producto {
                border-radius: 0;
                padding: 10px 0;
            }

            .producto img {
                width: 90%;
            }

            .agregar-carrito {
                width: 90%;
            }
        }




    </style>

    <br><br> <br><br>
    <!-- Contenedor principal -->
    <div class="producto-detalle">
        <!-- Imagen principal e imágenes de referencia -->
        <div class="imagenes">
            <img src="<?= $producto['imagen_principal'] ?>" alt="<?= $producto['nombre'] ?>" class="imagen-principal" id="imagen-principal">
            <div class="imagenes-secundarias">
                <?php foreach ($imagenes as $img): ?>
                    <img src="<?= $img ?>" alt="Imagen secundaria" class="miniatura">
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Información del producto -->
        <div class="info">
            <span class="envio-gratis_header"><svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 42 42" xml:space="preserve">
                    <path fill="#0a8800" d="M39.04,7.604l-2.398-1.93c-1.182-0.95-1.869-0.939-2.881,0.311L16.332,27.494l-8.111-6.739
        c-1.119-0.94-1.819-0.89-2.739,0.26l-1.851,2.41c-0.939,1.182-0.819,1.853,0.291,2.78l11.56,9.562c1.19,1,1.86,0.897,2.78-0.222
        l21.079-25.061C40.331,9.294,40.271,8.583,39.04,7.604z" />
                </svg>Envio Gratis</span>
            <h1><?= $producto['nombre'] ?></h1>
            <p class="descripcion"><?= $producto['descripcion'] ?></p>


            <?php if (!empty($producto['colores'])): ?>
    <p class="titulo-colores">Colores: 
        <?php 
        $colores = array_filter(explode(',', $producto['colores'])); // Filtrar colores vacíos
        foreach ($colores as $color): ?>
            <span class="color-circular" style="background-color:<?= htmlspecialchars($color, ENT_QUOTES, 'UTF-8') ?>;"></span>
        <?php endforeach; ?>
    </p>
<?php endif; ?>



            <p class="precio_producto"> <svg xmlns="http://www.w3.org/2000/svg" focusable="false" viewBox="0 0 12 12">
                    <path fill="currentColor"
                        d="M3.15 11.96c-.14 0-.25-.05-.34-.11-.29-.2-.36-.58-.2-1.03L4.3 6H3.24a.74.74 0 01-.62-.32c-.14-.21-.15-.48-.04-.74L4.42.66c.16-.38.57-.66.97-.66H9.1c.26 0 .49.12.62.32a.8.8 0 01.04.74L7.68 5h1.09c.33 0 .58.16.69.42.05.15.13.53-.34.98l-5.27 5.22c-.28.26-.52.34-.7.34z" />
                </svg>
                S/<?= number_format($producto['precio'], 2) ?>  
    <?php if ($producto['precio_original'] != $producto['precio']): ?>
        <s>S/<?= number_format($producto['precio_original'], 2) ?></s>
    <?php endif; ?>
            </p>
            <span class="envio-gratis"> <a href="tu-enlace-pedido.html" target="_blank"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 490 490" xml:space="preserve">
                        <path fill="#0a8800" d="M490,232.42L382.664,123.597h-66.515V70.461H0v279.154h97.445c-0.404,2.835-0.625,5.728-0.625,8.673
        c0,33.775,27.475,61.25,61.25,61.25s61.25-27.475,61.25-61.25c0-2.945-0.221-5.838-0.625-8.673h113.542
        c-0.404,2.835-0.625,5.728-0.625,8.673c0,33.775,27.475,61.25,61.25,61.25c33.775,0,61.25-27.475,61.25-61.25
        c0-2.945-0.221-5.838-0.625-8.673H490V232.42z M158.07,399.122c-22.52,0-40.833-18.318-40.833-40.833
        c0-22.515,18.313-40.833,40.833-40.833c22.52,0,40.833,18.319,40.833,40.833C198.903,380.804,180.589,399.122,158.07,399.122z
         M295.732,123.597v205.602h-83.773c-10.371-19.136-30.636-32.16-53.889-32.16s-43.519,13.024-53.889,32.16H20.417V90.878h275.316
        V123.597z M392.862,399.122c-22.521,0-40.834-18.318-40.834-40.833c0-22.515,18.313-40.833,40.834-40.833
        c22.52,0,40.833,18.319,40.833,40.833C433.695,380.804,415.381,399.122,392.862,399.122z M469.583,329.199h-22.832
        c-10.371-19.136-30.636-32.16-53.889-32.16c-23.254,0-43.519,13.024-53.89,32.16h-22.823V144.014h57.98l95.454,96.78V329.199z" />
                        <polygon fill="#0a8800" points="60.172,215.383 87.111,215.383 87.111,205.91 60.172,205.91 60.172,189.226 90.328,189.226 90.413,179.664 
        49.917,179.664 49.917,240.413 60.172,240.413" />
                        <path fill="#0a8800" d="M112.663,219.991h13.473l14.512,20.422h13.035l-15.906-22.073c8.748-2.609,13.126-8.922,13.126-18.947
        c0-6.893-2.002-11.907-5.997-15.036c-3.996-3.127-10.637-4.693-19.902-4.693h-22.597v60.749h10.255V219.991z M112.663,188.964
        h13.034c5.502,0,9.329,0.739,11.472,2.217c2.143,1.475,3.218,4.202,3.218,8.169c0,3.968-1.046,6.853-3.133,8.646
        c-2.08,1.796-6.026,2.694-11.818,2.694h-12.773V188.964z" />
                        <polygon fill="#0a8800" points="209.385,230.766 175.926,230.766 175.926,214.513 205.036,214.513 205.036,205.39 175.926,205.39 175.926,189.311 
        208.339,189.311 208.339,179.664 165.671,179.664 165.671,240.413 209.385,240.413" />
                        <polygon fill="#0a8800" points="266.226,230.766 232.767,230.766 232.767,214.513 261.877,214.513 261.877,205.39 232.767,205.39 232.767,189.311 
        265.18,189.311 265.18,179.664 222.512,179.664 222.512,240.413 266.226,240.413" />
                    </svg>

                    Pedido Contra Entrega</a></span>
            <span class="envio-gratis"> <a href="tu-enlace-devoluciones.html" target="_blank"><svg enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Layer_1" />
                        <g id="Layer_2">
                            <g fill="#0a8800">
                                <path d="M256.1,424.2c44.9,0,87.1-17.5,118.9-49.3c29.5-29.5,46.9-68.7,49-110.4c0.2-4.1-3-7.7-7.1-7.9c-4.1-0.2-7.7,3-7.9,7.1    c-1.9,37.9-17.8,73.6-44.7,100.5c-28.9,28.9-67.4,44.9-108.3,44.9s-79.4-15.9-108.3-44.9c-59.7-59.7-59.7-156.9,0-216.6    c50.9-50.9,130.1-59.4,190.3-21.1l-16.9,20.7l48.5-4.9l-4.9-48.5l-17.1,21c-66.3-43.2-154.2-34.1-210.5,22.2    c-65.6,65.6-65.6,172.2,0,237.8C169,406.7,211.2,424.2,256.1,424.2z" />
                                <path d="M335.4,221.4c0-0.1,0-0.2-0.1-0.2c0-0.2-0.1-0.3-0.1-0.5c0-0.1-0.1-0.3-0.1-0.4c0-0.1-0.1-0.2-0.1-0.3    c-0.2-0.5-0.4-0.9-0.7-1.3c0,0,0,0,0,0L302.5,172c-1.4-2.1-3.7-3.3-6.2-3.3h-80.6c-2.5,0-4.8,1.2-6.2,3.3l-31.8,46.6c0,0,0,0,0,0    c-0.3,0.4-0.5,0.9-0.7,1.3c0,0.1-0.1,0.2-0.1,0.3c-0.1,0.1-0.1,0.3-0.1,0.4c0,0.2-0.1,0.3-0.1,0.5c0,0.1,0,0.2-0.1,0.2    c-0.1,0.5-0.2,1-0.2,1.5c0,0,0,0,0,0v112.9c0,4.1,3.4,7.5,7.5,7.5H328c4.1,0,7.5-3.4,7.5-7.5V222.9c0,0,0,0,0,0    C335.5,222.3,335.5,221.8,335.4,221.4z M219.7,183.7h72.6l21.5,31.6H198.1L219.7,183.7z M320.5,328.3H191.5v-97.9h129.1V328.3z" />
                    </svg>
                    Devoluciones: 30 días</a></span>
            <span class="envio-gratis"> <a href="tu-enlace-seguridad.html" target="_blank"><svg width="24" height="24" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.876 21.464l8.732-8.732-1.532-1.532-7.2 7.149-2.809-2.809-1.532 1.532 4.341 4.392zM16.071 4l9.804 4.392v6.536c0 6.026-4.187 11.694-9.804 13.072-5.617-1.379-9.804-7.047-9.804-13.072v-6.536l9.804-4.391z">
                        </path>
                    </svg>Seguridad en las compras</a></span>
            <br>
            <button onclick="agregarAlCarrito(event, '<?= $producto['nombre'] ?>', '<?= $producto['imagen_principal'] ?>', <?= $producto['precio'] ?>, <?= $producto['precio_original'] ?>)" class="agregar-carrito_producto">Agregar al carrito</button>        </div>
    </div>

    <section class="productos-relacionados">
    <h2>Productos relacionados</h2>
    <div class="productos">
        <?php while ($relacionado = $resultado_relacionados->fetch_assoc()): ?>
            <a href="producto.php?id=<?= $relacionado['id'] ?>" class="producto">
                <img src="<?= $relacionado['imagen_principal'] ?>" alt="<?= $relacionado['nombre'] ?>">
                <p class="nombre"><?= $relacionado['nombre'] ?></p>
                <p class="precio">S/<?= number_format($relacionado['precio'], 2) ?>
                    <?php if ($relacionado['descuento'] > 0): ?>
                        <s>S/<?= number_format($relacionado['precio_original'], 2) ?></s>
                    <?php endif; ?>
                </p>
                <?php if ($relacionado['descuento'] > 0): ?>
                    <p class="descuento"><?= $relacionado['descuento'] ?>% de descuento</p>
                    <?php else: ?>
                    <br> <br>
                <?php endif; ?>
                <button onclick="agregarAlCarrito(event, '<?= $relacionado['nombre'] ?>', '<?= $relacionado['imagen_principal'] ?>', <?= $relacionado['precio'] ?>, <?= $relacionado['precio_original'] ?>)" class="agregar-carrito">Agregar al carrito</button>
            </a>
        <?php endwhile; ?>
    </div>
</section>


    <?php $conn->close(); ?>

    <?php include 'includes/carrito.php'; ?>
    <?php include 'includes/footer.php'; ?>




    <script>
        const imagenPrincipal = document.getElementById("imagen-principal");
        const miniaturas = document.querySelectorAll(".miniatura");

        miniaturas.forEach(miniatura => {
            miniatura.addEventListener("click", () => {
                imagenPrincipal.src = miniatura.src;
            });
        });
    </script>
</body>

</html>