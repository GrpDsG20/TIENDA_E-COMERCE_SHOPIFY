<?php

include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero
        if ($stmt->execute()) {
            echo "Producto eliminado correctamente.";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    $conn->close();
    header('Location: admin_catalogo.php'); // Redirigir de vuelta a la lista de productos
    exit(); // Asegúrate de detener la ejecución después de redirigir
} else {
    echo "ID de producto no proporcionado.";
}
?>