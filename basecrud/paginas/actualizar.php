<?php
include "../config/basededatos.php";



$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];

$query = "UPDATE productos SET nombre = '$nombre', precio = $precio, id_categoria1 = $categoria, descripcion = '$descripcion' WHERE id_producto = $id";


ejectutar($query ,"localhost", "el_esfuerzo", "root", "password");
header("Location: iniciocrud.php");
?>