<?php
session_start();
if (isset($_SESSION["id"])){
    header("Location: iniciocrud.php");
    exit();
}

if (isset($_COOKIE["session"]) && $_COOKIE["session"] === "activa") {
    $_SESSION["id"] = 1;
    $_SESSION["usuario"] = $_COOKIE["usuario"];
    setcookie("session", "activa", time() + 60);
    header("Location: iniciocrud.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html>
    <header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/fondologs.css">
    </header>
    <body>
        <div class="cointainer mt-3 p-3 w-5">
            <img src="../grafico/elEsfuerzo.png" class="rounded mx-auto d-block" style="max-width:10%">
        </div>
        <div class="container mt-3 p-3 w-25 bg-white border rounded">
            <h1 class="text-center p-3">bienvenido usuario!</h1>
            <form method="POST" action="validar.php"><br>
                <div class="mb-3">
                    <label for=usuario class="input-label">Nombre de usuario</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for=contrasenia class="input-label">contraseña</label>
                    <input type="password" id="contraseña" name="contrasenia" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" name="recuerdame">
                    <label>recuérdame</label>
                </div>
                <input type="submit" value="iniciar sesión"><br>
            </form>
        </div>
    </body>
</html>