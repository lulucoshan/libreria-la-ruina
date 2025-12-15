<?php
//request ajax nota: por nada del mundo nunca poner un comentario fuera de la etiqueta de php fuuuuck
require_once  "../config/neobasededatos.php";

$id = $_GET['id'] ?? null;

if(!$id) {
    http_response_code(400);
    echo json_encode(["error" => "ID requerido"]);
    exit;
}

$libro = seleccionar("SELECT id_libro, titulo, autor, precio, id_categoria1, idioma, stock FROM libros where id_libro = ?",[$id]);

if (!$libro) {
    http_response_code(404);
    echo json_encode(["error" => "libro no encontrado"]);
    exit;
}

header ('Content-Type: application/json');
echo json_encode($libro[0]);