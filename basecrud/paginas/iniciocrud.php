<?php
session_start();
if(!isset($_SESSION["id"])){
  header("Location: iniSesCrud.php");
  exit();
}

ini_set('display-errors', E_ALL);

include "../config/basededatos.php";
include "modalInsertar.php";
include "modalEditar.php";
include "modalBorrar.php";

$datos = seleccionar("SELECT productos.id_producto, productos.nombre, productos.precio, categorias.categoria AS nombre_categoria, productos.descripcion FROM productos join categorias on productos.id_categoria1 = categorias.id_categoria;", "localhost", "el_esfuerzo", "root", "password");
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
    <title>c.r.u.d el esfuerzote</title>
  </head>
  <body>
    <div class="container mt-3 p-3 border rounded bg-white">
      <h2 class="text-center">Bievenido al sistema el esfuerzo C.R.U.D</h2>
      <a href="#" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modalInsertar">Añadir producto</a>
      <table class="display" id="tablaproductos">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoria</th>
            <th>Descripción</th>
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
  <a href="cerrarSes.php" class="btn btn-danger mx-1">cerrar sesión</a>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../DataTables/datatables.js"></script>
  <script> $(document).ready(function (){
    $('#tablaproductos').DataTable();
  });
  </script>
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
