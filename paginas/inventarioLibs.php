<?php
session_start();
if(!isset($_SESSION["id"])){
  header("Location: iniSesCrud.php");
  exit();
}

ini_set('display-errors', E_ALL);

//include "../config/basededatos.php";
require_once "../config/neobasededatos.php";
include "modalInsertar.php";
include "modalEditar.php";
include "modalBorrar.php";


$datos = seleccionar("SELECT libros.id_libro, libros.titulo, libros.autor, libros.precio, categorias_libros.categoria AS nombre_categoria, libros.idioma, libros.stock FROM libros join categorias_libros on libros.id_categoria1 = categorias_libros.id_categoria;");
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
            <td><?php echo $dato['titulo']?></td>
            <td><?php echo $dato['autor']?></td>
            <td><?php echo $dato['precio']?></td>
            <td><?php echo $dato['nombre_categoria']?></td>
            <td><?php echo $dato['idioma']?></td>
            <td><?php echo $dato['stock']?></td>
            <td>
              <a href="#" class="btn btn-warning mx-1 btn-editar" data-bs-toggle="modal" data-bs-target="#modalEditar" data-id="<?php echo $dato['id_libro']?>">Editar</a>
              <a href="#" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#modalBorrar" data-bs-id="<?php echo $dato['id_libro']?>">Eliminar</a>
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
    document.addEventListener('DOMContentLoaded', () => {

      document.querySelectorAll('.btn-editar').forEach(btn => {
        btn.addEventListener('click', async () => {

          const id = btn.dataset.id;

          try{
            const res = await fetch(`getLibro.php?id=${id}`);
            const data = await res.json();

            document.querySelector('#modalEditar input[name="id"]').value = data.id_libro;
            document.querySelector('#modalEditar input[name="titulo"]').value = data.titulo;
            document.querySelector('#modalEditar input[name="autor"]').value = data.autor;
            document.querySelector('#modalEditar input[name="precio"]').value = data.precio;
            document.querySelector('#modalEditar select[name="categoria"]').value = data.id_categoria1;
            document.querySelector('#modalEditar input[name="idioma"]').value = data.idioma;
            document.querySelector('#modalEditar input[name="stock"]').value = data.stock;

          } catch (err){
            console.error("Error cargando el libro: ", err);
          }
        });
      });
    });
  </script>
</html>
