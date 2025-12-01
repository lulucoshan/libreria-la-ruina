<?php
include "../config/basededatos.php";

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$descripcion = $_POST['descripcion'];

$query = "INSERT INTO productos(nombre, precio, id_categoria1, descripcion) values('$nombre', '$precio', '$categoria', '$descripcion')";


insertar($query ,"localhost", "el_esfuerzo", "root", "password");
header("Location: iniciocrud.php");
?>