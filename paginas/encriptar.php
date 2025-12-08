<?php
require_once("../config/basededatos.php");

if (!isset($_POST["ussr1"])){
    echo("shoo no mirar aqui shoo");
    exit();
}

$usuario = $_POST["ussr1"];
$contrasenia = password_hash($_POST["newpssw"], PASSWORD_DEFAULT);

$query = "INSERT INTO usuarios (nombre_usr, contrasenia)
          VALUES ('$usuario', '$contrasenia')";

insertar($query, "localhost", "el_esfuerzo", "root", "password");

echo "Usuario registrado correctamente<br>";
echo "<a href='iniSesCrud.php'>Volver al inicio de sesión</a>";
?>