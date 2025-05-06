<?php
include 'conexion.php';

// Obtener los datos enviados desde JavaScript
$datos = json_decode(file_get_contents('php://input'), true);

// Extraer datos del cliente
$cliente = $datos['cliente'];
$nombre = $cliente['nombre'];
$contacto = $cliente['contacto'];
$correo = $cliente['correo'];
$direccion = $cliente['direccion'];
$pais = $cliente['pais'];
$departamento = $cliente['departamento'];
$provincia = $cliente['provincia'];
$distrito = $cliente['distrito'];

// Extraer datos del carrito
$productos = $datos['productos'];
$total = $datos['total'];

// Insertar datos del cliente en la tabla "clientes"
$stmt_cliente = $conn->prepare("INSERT INTO clientes (nombre, contacto, correo, direccion, pais, departamento, provincia, distrito) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt_cliente->bind_param("ssssssss", $nombre, $contacto, $correo, $direccion, $pais, $departamento, $provincia, $distrito);

if ($stmt_cliente->execute()) {
    $id_cliente = $stmt_cliente->insert_id; // Obtener el ID del cliente recién insertado

    // Insertar datos de la compra en la tabla "compras"
    $stmt_compra = $conn->prepare("INSERT INTO compras (id_cliente, total) VALUES (?, ?)");
    $stmt_compra->bind_param("id", $id_cliente, $total);

    if ($stmt_compra->execute()) {
        $id_compra = $stmt_compra->insert_id; // Obtener el ID de la compra recién insertada

        // Insertar productos del carrito en la tabla "detalle_compra"
        foreach ($productos as $producto) {
            $nombre_producto = $producto['nombre'];
            $imagen = $producto['imagen']; // Obtener la imagen del producto
            $precio = $producto['precio'];
            $cantidad = $producto['cantidad'];

            $stmt_detalle = $conn->prepare("INSERT INTO detalle_compra (id_compra, nombre_producto, imagen, precio, cantidad) VALUES (?, ?, ?, ?, ?)");
            $stmt_detalle->bind_param("issdi", $id_compra, $nombre_producto, $imagen, $precio, $cantidad);
            $stmt_detalle->execute();
            $stmt_detalle->close();
        }

        echo json_encode(['success' => true, 'message' => 'Compra registrada correctamente.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar la compra.']);
    }

    $stmt_compra->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error al registrar el cliente.']);
}

$stmt_cliente->close();
$conn->close();
