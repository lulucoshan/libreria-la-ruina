<?php
require_once "../config/neobasededatos.php";

$data = json_decode(file_get_contents("php://input"), true);
$carrito = $data['carrito'];

$pdo = baseDedatos::conectar();
$pdo->beginTransaction();

$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

$stmt = $pdo->prepare("
    INSERT INTO ventas (total)
    VALUES (?)
    RETURNING id_venta
");
$stmt->execute([$total]);
$idVenta = $stmt->fetchColumn();

foreach ($carrito as $item) {
    $pdo->prepare("
        INSERT INTO venta_detalle (id_venta, id_libro, cantidad, precio)
        VALUES (?, ?, ?, ?)
    ")->execute([$idVenta, $item['id'], $item['cantidad'], $item['precio']]);

    $pdo->prepare("
        UPDATE libros SET stock = stock - ?
        WHERE id_libro = ?
    ")->execute([$item['cantidad'], $item['id']]);
}

$pdo->commit();

echo json_encode(["ok" => true, "id_venta" => $idVenta]);