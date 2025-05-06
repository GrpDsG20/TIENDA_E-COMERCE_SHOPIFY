<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primero eliminar los detalles del pedido
    $stmt = $conn->prepare("DELETE FROM detalle_compra WHERE id_compra = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Luego eliminar el pedido de la tabla compras
    $stmt = $conn->prepare("DELETE FROM compras WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirigir al panel de pedidos
    header('Location: panel.php');
    exit();
}
?>
