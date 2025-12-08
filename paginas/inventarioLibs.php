<?php
//session_start();
//if(!isset($_SESSION["id"])){
//  header("Location: iniSesCrud.php");
//  exit();
//}

ini_set('display-errors', E_ALL);

include "../config/basededatos.php";
include "modalInsertar.php";
include "modalEditar.php";
include "modalBorrar.php";

$datos = seleccionar("SELECT libros.id_libro, libros.titulo, libros.autor, libros.precio, categorias_libros.categoria AS nombre_categoria, libros.idioma, libros.stock FROM libros join categorias_libros on libros.id_categoria1 = categorias_libros.id_categoria;", "localhost", "libreria_la_ruina", "root", "password");
?>

<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../DataTables/datatables.css" />
    <link rel="stylesheet" href="../css/fondocool.css" />
    <title>P.O.S 3000 libreria la ruina! </title>
  </head>

  <!--barra de navegación copiable para cualquier pagina del sistema exepto el login-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="../imgs/logo.png" width="200"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            opciones
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="cerrarSes.php">Cerrar sessión</a></li>
            <li><a class="dropdown-item" href="#">Editar cuenta</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <!-- inicio del cuerpo contenedor de la tabla principal del inventario de la libreria-->
  <body>
    <div class="container mt-3 p-3 border rounded bg-white">
      <h2 class="text-center">Seleccionar operación</h2>
      <a href="#" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modalInsertar">Añadir producto</a>
      <table class="display" id="tablaproductos">
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Precio</th>
            <th>Categoria</th>
            <th>Idioma</th>
            <th>En stock</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($datos as $dato):?>
          <tr>
            <td><?php echo $dato[1]?></td>
            <td><?php echo $dato[2]?></td>
            <td><?php echo $dato[3]?></td>
            <td><?php echo $dato[4]?></td>
            <td><?php echo $dato[5]?></td>
            <td><?php echo $dato[6]?></td>
            <td>
              <a href="#" class="btn btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#modalEditar" data-bs-id="<?php echo $dato[0]?>"
              data-bs-nombre="<?php echo $dato[1]?>"
              data-bs-precio="<?php echo $dato[2]?>"
              data-bs-descripcion="<?php echo $dato[4]?>">Editar</a>
              <a href="#" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#modalBorrar" data-bs-id="<?php echo $dato[0]?>">Eliminar</a>
            </td>
          </tr>
          <?php endforeach?>
        </tbody>
      </table>
  </body>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../DataTables/datatables.js"></script>
  <script> $(document).ready(function (){
    $('#tablaproductos').DataTable();
  });
  </script>
  <!-- script para obtener los parametros de el campo a modificar TODO: cambiar por un request ajax -->
  <script>
    modalEditar.addEventListener('shown.bs.modal', event => {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id');
    let nombre = button.getAttribute('data-bs-nombre');
    let precio = button.getAttribute('data-bs-precio');
    let categoria = button.getAttribute('data-bs-categoria');
    let descripcion = button.getAttribute('data-bs-descripcion');

    let inputId = modalEditar.querySelector('.modal-body #id');
    let inputNombre = modalEditar.querySelector('.modal-body #nombre');
    let inputPrecio = modalEditar.querySelector('.modal-body #precio');
    let inputDescripcion = modalEditar.querySelector('.modal-body #descripcion');

    inputId.value = id;
    inputNombre.value = nombre;
    inputPrecio.value = precio;
    inputDescripcion.value= descripcion;

    });

  </script>
</html>
