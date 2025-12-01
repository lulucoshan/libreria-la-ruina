<?php
include "../config/basededatos.php";



$id = $_POST['id'];


$query = "DELETE FROM productos WHERE id_producto = $id";


ejectutar($query ,"localhost", "el_esfuerzo", "root", "password");
header("Location: iniciocrud.php");
?>