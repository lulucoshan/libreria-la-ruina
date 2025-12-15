<?php
require_once "../config/neobasededatos.php";

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$idioma = $_POST['idioma'];
$stock = $_POST['stock'];

ejecutar("INSERT INTO libros(titulo, autor, precio, id_categoria1, idioma, stock) VALUES (?, ?, ?, ?, ?, ?)",[$titulo, $autor, $precio, $categoria, $idioma, $stock]);


//inserto de portada experimental work in progress?
if (!empty($_FILES['portada']['name'])) {

    $directorio = "../uploads/portadas/";
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    $extension = strtolower(pathinfo($_FILES['portada']['name'], PATHINFO_EXTENSION));
    $permitidas = ['jpg', 'jpeg', 'png', 'webp'];

    if (in_array($extension, $permitidas)) {
        move_uploaded_file(
            $_FILES['portada']['tmp_name'],
            $directorio . $titulo . "." . $extension
        );
    }
}
header("Location: inventarioLibs.php");
?>