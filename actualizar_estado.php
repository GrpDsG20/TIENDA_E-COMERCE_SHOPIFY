<?php
include 'conexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$estado = $data['estado'];

$stmt = $conn->prepare("UPDATE compras SET estado = ? WHERE id = ?");
$stmt->bind_param("si", $estado, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>