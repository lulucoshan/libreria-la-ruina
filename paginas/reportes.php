<?php
require_once "../config/neobasededatos.php";

/* ====== VENTAS TOTALES ====== */
$ventasTotales = seleccionar("
    SELECT 
        COUNT(*) AS ordenes,
        IFNULL(SUM(total),0) AS total
    FROM ventas
")[0];

/* ====== VENTAS ÚLTIMOS 14 DÍAS ====== */
$ventasPorDia = seleccionar("
    SELECT 
        DATE(fecha) AS dia,
        SUM(total) AS total
    FROM ventas
    WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 14 DAY)
    GROUP BY DATE(fecha)
    ORDER BY dia
");

/* ====== CATEGORÍAS MÁS VENDIDAS ====== */
$categorias = seleccionar("
    SELECT 
        c.categoria,
        SUM(d.cantidad) AS total
    FROM venta_detalle d
    JOIN libros l ON l.id_libro = d.id_libro
    JOIN categorias_libros c ON c.id_categoria = l.id_categoria1
    GROUP BY c.id_categoria
    ORDER BY total DESC
    LIMIT 3
");

/* ====== PREPARAR DATOS PARA JS ====== */
$dias = [];
$totales = [];
foreach ($ventasPorDia as $v) {
    $dias[] = $v['dia'];
    $totales[] = $v['total'];
}

$catLabels = [];
$catTotales = [];
foreach ($categorias as $c) {
    $catLabels[] = $c['categoria'];
    $catTotales[] = $c['total'];
}
?>

<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../DataTables/datatables.css" />
    <link rel="stylesheet" href="../css/fondocool.css" />
    <title>P.O.S 3000 libreria la ruina dashboard </title>
  </head>

  <!--barra de navegación copiable para cualquier pagina del sistema exepto el login-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="../imgs/logo.png" width="200"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            opciones
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cerrarSes.php">Cerrar sessión</a></li>
            <li><a class="dropdown-item" href="#">Editar cuenta</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <!-- inicio del cuerpo contenedor de la tabla principal del inventario de la libreria-->
  <body>
    <div class="container mt-4">

<div class="row g-4">
  <!-- Ventas Totales -->
  <div class="col-md-4">
    <div class="card bg-dark text-white rounded-4 p-3">
      <h6>Ventas totales</h6>
      <h2>$<?= number_format($ventasTotales['total'],2) ?></h2>
      <small><?= $ventasTotales['ordenes'] ?> órdenes</small>
    </div>
  </div>

  <!-- Categorías -->
  <div class="col-md-4">
    <div class="card rounded-4 p-3">
      <h6>Categorías más vendidas</h6>
      <canvas id="categoriasChart"></canvas>
    </div>
  </div>
</div>

<!-- Gráfica ventas -->
<div class="card mt-4 rounded-4 p-3">
  <h6>Ventas últimos 14 días</h6>
  <canvas id="ventasChart"></canvas>
</div>

</div>
  </body>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../DataTables/datatables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
/* ====== VENTAS ====== */
new Chart(document.getElementById('ventasChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($dias) ?>,
        datasets: [{
            label: 'Ingresos',
            data: <?= json_encode($totales) ?>
        }]
    }
});

/* ====== CATEGORÍAS ====== */
new Chart(document.getElementById('categoriasChart'), {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($catLabels) ?>,
        datasets: [{
            data: <?= json_encode($catTotales) ?>
        }]
    }
});
</script>
 
</html>