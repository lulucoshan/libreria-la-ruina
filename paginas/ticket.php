<?php
require_once "../config/neobasededatos.php";

$id = $_GET['id'];

$venta = seleccionar("SELECT * FROM ventas WHERE id_venta = ?", [$id])[0];
$items = seleccionar("
    SELECT l.titulo, d.cantidad, d.precio
    FROM venta_detalle d
    JOIN libros l ON l.id_libro = d.id_libro
    WHERE d.id_venta = ?
", [$id]);
?>
<body onload="window.print()">
<h3>Librería La Ruina</h3>
<hr>
<?php foreach ($items as $i): ?>
<?php echo $i['titulo']; ?> x<?php echo $i['cantidad']; ?>
$<?php echo $i['precio'] * $i['cantidad']; ?><br>
<?php endforeach; ?>
<hr>
TOTAL: $<?php echo $venta['total']; ?>
</body>