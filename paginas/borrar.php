<?php
require_once "../config/neobasededatos.php";

$id = $_POST['id'];

// borrar libro
ejecutar(
    "DELETE FROM libros WHERE id_libro = ?",
    [$id]
);


header("Location: inventarioLibs.php");
exit;