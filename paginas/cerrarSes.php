<?php
session_start();
session_destroy();

if (isset($_COOKIE["session"])){
    setcookie("session","", time() - 600);
}

header("Location: iniSesCrud.php");
exit();
?>