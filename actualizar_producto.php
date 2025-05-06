<?php
include 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$precio_original = $_POST['precio_original'];
$descuento = $_POST['descuento'];
$stock = $_POST['stock'];
$categoria_id = intval($_POST['categoria']);
$categoria_secundaria_id = intval($_POST['categoria_secundaria']);

// Capturar colores seleccionados
$colores_seleccionados = array_filter([
    $_POST['color_1'] ?? '',
    $_POST['color_2'] ?? '',
    $_POST['color_3'] ?? '',
    $_POST['color_4'] ?? '',
    $_POST['color_5'] ?? ''
], fn($color) => !empty(trim($color)) && strtolower(trim($color)) !== '#e6e6e6');

$colores = implode(',', $colores_seleccionados);

// Obtener la imagen principal actual y las secundarias existentes
$query = "SELECT imagen_principal FROM productos WHERE id = '$id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$imagen_principal_actual = $row['imagen_principal'];

// Verificar si se sube una nueva imagen principal
if (!empty($_FILES['imagen_principal']['name'])) {
    $imagen_principal = 'uploads/' . basename($_FILES['imagen_principal']['name']);
    move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $imagen_principal);
} else {
    $imagen_principal = $imagen_principal_actual;
}

// Actualizar el producto principal
$sql = "UPDATE productos SET 
    nombre='$nombre', 
    descripcion='$descripcion', 
    precio='$precio', 
    precio_original='$precio_original', 
    descuento='$descuento', 
    stock='$stock', 
    categoria_id='$categoria_id', 
    categoria_secundaria_id='$categoria_secundaria_id', 
    colores='$colores', 
    imagen_principal='$imagen_principal'
    WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    // Manejar imágenes secundarias
    if (!empty($_FILES['imagenes']['name'][0])) {
        // Eliminar imágenes secundarias actuales
        $conn->query("DELETE FROM imagenes_productos WHERE producto_id = '$id'");

        // Guardar nuevas imágenes secundarias (máx. 5)
        $imagenes = array_slice($_FILES['imagenes']['name'], 0, 5);
        foreach ($imagenes as $key => $nombre_img) {
            $tmp_name = $_FILES['imagenes']['tmp_name'][$key];
            $ruta_img = 'uploads/' . basename($nombre_img);
            move_uploaded_file($tmp_name, $ruta_img);

            $stmt = $conn->prepare("INSERT INTO imagenes_productos (producto_id, imagen) VALUES (?, ?)");
            $stmt->bind_param("is", $id, $ruta_img);
            $stmt->execute();
            $stmt->close();
        }
    }

    echo "<script>alert('Producto actualizado correctamente'); window.location.href='admin_catalogo.php';</script>";
} else {
    echo "Error al actualizar: " . $conn->error;
}

$conn->close();
?>