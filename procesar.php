<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $precio_original = $_POST['precio_original'];
    $descuento = $_POST['descuento'];
    $stock = $_POST['stock'];
    $categoria_id = intval($_POST['categoria']); // Aseguramos que sea un número
    $categoria_secundaria_id = intval($_POST['categoria_secundaria']); // Recibir la categoría secundaria

    // Verificar que la categoría principal exista
    $stmt = $conn->prepare("SELECT id FROM categorias WHERE id = ?");
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "<script>alert('Categoría principal inválida.'); window.location.href='admin.php';</script>";
        exit();
    }
    $stmt->close();

    // Verificar que la categoría secundaria exista
    $stmt = $conn->prepare("SELECT id FROM categoria_secundaria WHERE id = ?");
    $stmt->bind_param("i", $categoria_secundaria_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "<script>alert('Categoría secundaria inválida.'); window.location.href='admin.php';</script>";
        exit();
    }
    $stmt->close();

    // Guardar imagen principal
    $imagen_principal = 'uploads/' . basename($_FILES['imagen_principal']['name']);
    move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $imagen_principal);


 // Recoger los colores seleccionados y unirlos con comas
$colores_seleccionados = array_filter([
    $_POST['color_1'] ?? '',
    $_POST['color_2'] ?? '',
    $_POST['color_3'] ?? '',
    $_POST['color_4'] ?? '',
    $_POST['color_5'] ?? ''
], fn($color) => !empty(trim($color)) && strtolower(trim($color)) !== '#e6e6e6');

$colores = implode(',', $colores_seleccionados);

    // Insertar producto en la BD
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, imagen_principal, precio, precio_original, descuento, stock, categoria_id, categoria_secundaria_id, colores) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssddiiis", $nombre, $descripcion, $imagen_principal, $precio, $precio_original, $descuento, $stock, $categoria_id, $categoria_secundaria_id, $colores);
    $stmt->execute();
    $producto_id = $stmt->insert_id;
    $stmt->close();

    // Guardar imágenes adicionales (si las hay)
    if (!empty($_FILES['imagenes']['name'][0])) {
        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            $imagen = 'uploads/' . basename($_FILES['imagenes']['name'][$key]);
            move_uploaded_file($tmp_name, $imagen);

            $stmt = $conn->prepare("INSERT INTO imagenes_productos (producto_id, imagen) VALUES (?, ?)");
            $stmt->bind_param("is", $producto_id, $imagen);
            $stmt->execute();
        }
        $stmt->close();
    }

    echo "<script>alert('Producto agregado correctamente'); window.location.href='admin.php';</script>";
}
?>
