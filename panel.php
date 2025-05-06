<?php
include 'conexion.php';

session_start();

// Verificar si el usuario está autenticado y tiene el rol de admin o ventas
if (
    !isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true ||
    ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'ventas')
) {
    // Redirigir al login si no está autenticado o no tiene el rol adecuado
    header('Location: login.php');
    exit();
}

// Obtener el filtro de estado si existe
$filtro_estado = isset($_GET['estado']) ? $_GET['estado'] : '';

// Obtener la cantidad de pedidos por página (25, 50, 100)
$por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 25;

// Paginación
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $por_pagina;

// Obtener los IDs de los pedidos filtrados y paginados
$query_ids = "
    SELECT c.id
    FROM compras c
    JOIN clientes cl ON c.id_cliente = cl.id
    WHERE (? = '' OR c.estado = ?)
    ORDER BY c.fecha DESC
    LIMIT ? OFFSET ?
";
$stmt_ids = $conn->prepare($query_ids);
$stmt_ids->bind_param("ssii", $filtro_estado, $filtro_estado, $por_pagina, $offset);
$stmt_ids->execute();
$resultado_ids = $stmt_ids->get_result();

$ids_compra = [];
while ($fila = $resultado_ids->fetch_assoc()) {
    $ids_compra[] = $fila['id'];
}

// Si no hay IDs, no hay pedidos en esta página
if (empty($ids_compra)) {
    $pedidos = [];
} else {
    // Obtener los detalles de los pedidos filtrados y paginados
    $query_pedidos = "
        SELECT 
            c.id AS id_compra,
            c.fecha,
            c.total,
            c.estado,
            cl.nombre AS nombre_cliente,
            cl.contacto,
            cl.correo,
            cl.direccion,
            cl.pais,
            cl.departamento,
            cl.provincia,
            cl.distrito,
            d.nombre_producto,
            d.cantidad,
            d.precio,
            d.imagen
        FROM compras c
        JOIN clientes cl ON c.id_cliente = cl.id
        JOIN detalle_compra d ON c.id = d.id_compra
        WHERE c.id IN (" . implode(",", $ids_compra) . ")
        ORDER BY c.fecha DESC
    ";
    $stmt_pedidos = $conn->prepare($query_pedidos);
    $stmt_pedidos->execute();
    $resultado_pedidos = $stmt_pedidos->get_result();

    // Agrupar los productos por pedido
    $pedidos = [];
    while ($fila = $resultado_pedidos->fetch_assoc()) {
        $id_compra = $fila['id_compra'];
        if (!isset($pedidos[$id_compra])) {
            $pedidos[$id_compra] = [
                'fecha' => $fila['fecha'],
                'total' => $fila['total'],
                'estado' => $fila['estado'],
                'nombre_cliente' => $fila['nombre_cliente'],
                'contacto' => $fila['contacto'],
                'correo' => $fila['correo'],
                'direccion' => $fila['direccion'],
                'departamento' => $fila['departamento'],
                'provincia' => $fila['provincia'],
                'distrito' => $fila['distrito'],
                'productos' => []
            ];
        }
        $pedidos[$id_compra]['productos'][] = [
            'nombre_producto' => $fila['nombre_producto'],
            'cantidad' => $fila['cantidad'],
            'precio' => $fila['precio'],
            'imagen' => $fila['imagen']
        ];
    }
}

// Obtener el total de pedidos filtrados para la paginación
$query_total = "
    SELECT COUNT(DISTINCT c.id) AS total_pedidos
    FROM compras c
    JOIN clientes cl ON c.id_cliente = cl.id
    WHERE (? = '' OR c.estado = ?)
";
$stmt_total = $conn->prepare($query_total);
$stmt_total->bind_param("ss", $filtro_estado, $filtro_estado);
$stmt_total->execute();
$resultado_total = $stmt_total->get_result();
$total_pedidos = $resultado_total->fetch_assoc()['total_pedidos'];
$total_paginas = ceil($total_pedidos / $por_pagina);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Pedidos</title>
    <link rel="stylesheet" href="style/panel.css">

</head>

<body>

    <?php include 'includes/navbar_admin.php'; ?>

    <br><br><br><br>

    <div class="contenedor-tabla">
        <h1>Panel de Pedidos</h1>
        <div class="filtros">
            <input type="text" id="buscar" placeholder="Buscar por nombre o codigo" onkeyup="filtrarTabla()">
            <select id="filtro-estado" onchange="filtrarTabla()">
                <option value="">Todos los estados</option>
                <option value="cancelado">Cancelado</option>
                <option value="resuelto">Resuelto</option>
                <option value="en-proceso">En proceso</option>
            </select>


            <select id="por-pagina" onchange="aplicarFiltro()">
                <option value="25" <?php echo $por_pagina == 25 ? 'selected' : ''; ?>>25</option>
                <option value="50" <?php echo $por_pagina == 50 ? 'selected' : ''; ?>>50</option>
                <option value="100" <?php echo $por_pagina == 100 ? 'selected' : ''; ?>>100</option>
            </select>


        </div>
        <table id="tabla-pedidos">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Productos</th>
                    <th>Cantidad</th>
                    <th>Precios</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $id_compra => $pedido) { ?>
                    <tr>
                        <td data-label="ID Compra"><?php echo $id_compra; ?></td>
                        <td data-label="Fecha"><?php list($fecha, $hora) = explode(' ', $pedido['fecha']);
                                                echo $fecha;
                                                echo '<br>';
                                                echo $hora; ?></td>
                        <td data-label="Cliente"><?php echo $pedido['nombre_cliente']; ?></td>
                        <td data-label="Contacto"><?php echo $pedido['contacto']; ?></td>
                        <td data-label="Correo"><?php echo $pedido['correo']; ?></td>
                        <td data-label="Dirección">
                            <?php echo $pedido['direccion'] . '<br>' . $pedido['departamento'] . '<br>' . $pedido['provincia'] . '<br>' . $pedido['distrito']; ?>
                        </td>
                        <td data-label="Productos">
                            <?php foreach ($pedido['productos'] as $producto) { ?>
                                <div class="producto">
                                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre_producto']; ?>">
                                    <span><?php echo $producto['nombre_producto']; ?></span>
                                </div>
                            <?php } ?>
                        </td>
                        <td data-label="Cantidades">
                            <?php foreach ($pedido['productos'] as $producto) { ?>
                                <div class="cantidades"><?php echo $producto['cantidad']; ?></div>
                            <?php } ?>

                        </td>
                        <td data-label="Precios">
                            <?php foreach ($pedido['productos'] as $producto) { ?>
                                <div class="precios">S/ <?php echo number_format($producto['precio'], 2); ?></div>
                            <?php } ?>
                        </td>
                        <td data-label="Total">S/ <?php echo number_format($pedido['total'], 2); ?></td>
                        <td data-label="Estado">
                            <select class="estado" onchange="actualizarEstado(<?php echo $id_compra; ?>, this.value)">
                                <option value="" <?php echo $pedido['estado'] === '' ? 'selected' : ''; ?>>Seleccionar </option>
                                <option value="cancelado" <?php echo $pedido['estado'] === 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                                <option value="resuelto" <?php echo $pedido['estado'] === 'resuelto' ? 'selected' : ''; ?>>Resuelto</option>
                                <option value="en-proceso" <?php echo $pedido['estado'] === 'en-proceso' ? 'selected' : ''; ?>>En proceso</option>
                            </select>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="paginacion">
        <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
            <a href="?pagina=<?php echo $i; ?>&estado=<?php echo $filtro_estado; ?>&por_pagina=<?php echo $por_pagina; ?>" class="<?php echo $i == $pagina_actual ? 'activa' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
    </div>
    </div>
    <br><br>
    <?php include 'includes/footer.php'; ?>

    <script src="JS/panel.js"></script>

</body>

</html>