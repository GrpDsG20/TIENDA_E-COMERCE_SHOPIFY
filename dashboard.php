<?php
include 'conexion.php'; // Conexión a la base de datos

// Obtener el mes y año seleccionados (si no se selecciona, usar el mes y año actual)
$mes_seleccionado = isset($_GET['mes']) ? (int)$_GET['mes'] : date('m');
$anio_seleccionado = isset($_GET['anio']) ? (int)$_GET['anio'] : date('Y');

// Consulta para obtener las ventas diarias del mes seleccionado
$query = "
    SELECT DAY(fecha) AS dia, COUNT(*) AS ventas
    FROM compras
    WHERE YEAR(fecha) = ? AND MONTH(fecha) = ?
    GROUP BY DAY(fecha)
    ORDER BY dia ASC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $anio_seleccionado, $mes_seleccionado);
$stmt->execute();
$resultado = $stmt->get_result();

$datos_ventas = [];
while ($fila = $resultado->fetch_assoc()) {
    $datos_ventas[$fila['dia']] = $fila['ventas'];
}

// Rellenar los días sin ventas con 0
$dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes_seleccionado, $anio_seleccionado);
for ($dia = 1; $dia <= $dias_mes; $dia++) {
    if (!isset($datos_ventas[$dia])) {
        $datos_ventas[$dia] = 0;
    }
}
ksort($datos_ventas); // Ordenar por día

// Obtener el total de ventas mensuales
$total_ventas_mensual = array_sum($datos_ventas);

// Obtener las ventas del día anterior para comparar
$dia_anterior = date('d') - 1;
if ($dia_anterior < 1) {
    $dia_anterior = $dias_mes;
    $mes_anterior = $mes_seleccionado - 1;
    $anio_anterior = $anio_seleccionado;
    if ($mes_anterior < 1) {
        $mes_anterior = 12;
        $anio_anterior--;
    }
} else {
    $mes_anterior = $mes_seleccionado;
    $anio_anterior = $anio_seleccionado;
}

$query_dia_anterior = "
    SELECT COUNT(*) AS ventas
    FROM compras
    WHERE YEAR(fecha) = ? AND MONTH(fecha) = ? AND DAY(fecha) = ?
";
$stmt_dia_anterior = $conn->prepare($query_dia_anterior);
$stmt_dia_anterior->bind_param("iii", $anio_anterior, $mes_anterior, $dia_anterior);
$stmt_dia_anterior->execute();
$resultado_dia_anterior = $stmt_dia_anterior->get_result();
$ventas_dia_anterior = $resultado_dia_anterior->fetch_assoc()['ventas'];

// Calcular el porcentaje de cambio
$porcentaje_cambio = 0;
if ($ventas_dia_anterior > 0) {
    $ventas_hoy = $datos_ventas[date('d')] ?? 0;
    $porcentaje_cambio = (($ventas_hoy - $ventas_dia_anterior) / $ventas_dia_anterior) * 100;
}

// Obtener el mejor mes de ventas
$query_mejor_mes = "
    SELECT YEAR(fecha) AS anio, MONTH(fecha) AS mes, COUNT(*) AS ventas
    FROM compras
    GROUP BY YEAR(fecha), MONTH(fecha)
    ORDER BY ventas DESC
    LIMIT 1
";
$resultado_mejor_mes = $conn->query($query_mejor_mes);
$mejor_mes = $resultado_mejor_mes->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'includes/navbar_admin.php'; ?>

    <div class="dashboard">
        <div class="buttons">
            <a href="admin_catalogo.php" class="btn">Todos los productos</a>
            <a href="admin_categorias.php" class="btn">Categorías</a>
            <a href="panel.php" class="btn">Panel Center</a>
            <a href="usuarios.php" class="btn">Usuarios</a>
        </div>

        <div class="filtros">
            <form method="GET" action="">
                <select name="mes">
                    <?php
                    $meses = [
                        1 => 'Enero',
                        2 => 'Febrero',
                        3 => 'Marzo',
                        4 => 'Abril',
                        5 => 'Mayo',
                        6 => 'Junio',
                        7 => 'Julio',
                        8 => 'Agosto',
                        9 => 'Septiembre',
                        10 => 'Octubre',
                        11 => 'Noviembre',
                        12 => 'Diciembre'
                    ];
                    foreach ($meses as $numero => $nombre) {
                        $seleccionado = ($numero == $mes_seleccionado) ? 'selected' : '';
                        echo "<option value='$numero' $seleccionado>$nombre</option>";
                    }
                    ?>
                </select>
                <select name="anio">
                    <?php
                    $anio_actual = date('Y');
                    for ($i = $anio_actual; $i >= 2020; $i--) {
                        $seleccionado = ($i == $anio_seleccionado) ? 'selected' : '';
                        echo "<option value='$i' $seleccionado>$i</option>";
                    }
                    ?>
                </select>
                <button type="submit">Filtrar</button>
            </form>
        </div>

        <div class="estadisticas">
            <div class="estadistica-item">
                <p>Total de ventas</p>
                <strong><?php echo $total_ventas_mensual; ?></strong>
            </div>
            <div class="estadistica-item">
                <p>Variación Hoy</p>
                <span style="color: <?php echo ($porcentaje_cambio >= 0) ? 'green' : 'red'; ?>;">
                    <?php echo number_format($porcentaje_cambio, 2); ?>%
                    <?php echo ($porcentaje_cambio >= 0) ? '↑' : '↓'; ?>
                </span>
            </div>
            <div class="estadistica-item">
                <p>Mejor mes</p>
                <strong><?php echo $meses[$mejor_mes['mes']]; ?></strong>
            </div>
        </div>
        <div class="chart">
            <canvas id="ventasChart"></canvas>
        </div>

        <br><br><br>

    </div>


    <?php include 'includes/footer.php'; ?>


    <script>
        // Obtener los datos de ventas desde PHP
        const dias = <?php echo json_encode(array_keys($datos_ventas)); ?>;
        const ventas = <?php echo json_encode(array_values($datos_ventas)); ?>;


        const ctx = document.getElementById('ventasChart').getContext('2d');
        const ventasChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dias,
                datasets: [{
                    label: 'Ventas diarias',
                    data: ventas,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>