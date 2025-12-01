<?php

if(!isset($_POST["usuario"])){
  echo "no deberias estar aqui punk";
  exit();
}

session_start();
require_once("../config/basededatos.php");

$usuario = $_POST["usuario"];
$contrasenia = $_POST["contrasenia"];
$recuerdame = isset($_POST["recuerdame"]);

$usuarios = seleccionar(
    "SELECT * FROM usuarios WHERE nombre_usr = '$usuario'",
    "localhost", "el_esfuerzo", "root", "password"
);

if (count($usuarios) > 0) {
    $user = $usuarios[0];

    if (password_verify($contrasenia, $user["2"])) {
        $_SESSION["id"] = $user["0"];
        $_SESSION["usuario"] = $user["1"];

        if ($recuerdame) {
            setcookie("session", "activa", time() + 60 * 5);
            setcookie("usuario", $user["1"], time() + 60 * 5);
        }

        header("Location: iniciocrud.php");
        exit();
    } else {
        echo "error de usuario o contraseña<br><a href='iniSesCrud.php'>Regresar</a>";
    }
} else {
    echo "error de usuario o contraseña<br><a href='iniSesCrud.php'>Regresar</a>";
}
?>