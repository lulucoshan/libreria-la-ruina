<?php

session_start();
if(!isset($_SESSION["id"])){
  header("Location: iniSesCrud.php");
  exit();
}

require_once "../config/neobasededatos.php";
include "modalCarrito.php";

$libros = seleccionar("SELECT id_libro, titulo, autor, precio from libros where stock > 0");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema P.O.S - realizar venta</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/fondocool.css" />


</head>
<body>

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

    <div class="container mt-4">
        
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="text-dark fw-normal">seleccionar libros a vender</h2>
            </div>
            <div class="col-md-6 d-flex justify-content-md-end align-items-center gap-3 mt-3 mt-md-0">
                <div class="search-container flex-grow-1 flex-md-grow-0">
                    <i class="fas fa-search search-icon"></i><br>
                    <input type="text" class="form-control form-control-search" id="searchInput" placeholder="Search..." onkeyup="filterBooks()">
                </div>
                <i class="fas fa-cart-plus text-white fs-2 cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalCarrito"></i>
            </div>
        </div>

        <div class="row g-4" id="bookGrid">
            <?php foreach ($libros as $libro): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 book-item"> 
                    <div class="card custom-card h-100 p-3">
                        <h5 class="card-title book-title"><?php echo $libro['titulo']; ?></h5>
                        <p class="card-text small op-75"><?php echo $libro['autor']; ?></p>
                        
                        <div class="card-img-area">
                            <img src="../uploads/portadas/<?php echo $libro['titulo']; ?>.webp"
                            onerror="this.onerror=null;this.src='../imgs/placeholder.jpg';"
                            class="img-fluid rounded"
                            style="max-height:180px; object-fit:contain;">
                            <button
                                class="btn btn-primary btn-sm mt-2 btn-add-cart"
                                onclick="agregarLibro('<?php echo $libro['id_libro']; ?>', '<?php echo addslashes($libro['titulo']); ?>', <?php echo $libro['precio']; ?>)">
                                <i class="fas fa-cart-plus"></i> Agregar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/carrito.js"></script>

    <script>
        function filterBooks() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const grid = document.getElementById('bookGrid');
            const items = grid.getElementsByClassName('book-item');

            for (let i = 0; i < items.length; i++) {
                // Buscamos dentro de la clase .book-title
                const titleElement = items[i].querySelector('.book-title');
                const titleText = titleElement.textContent || titleElement.innerText;

                if (titleText.toLowerCase().indexOf(filter) > -1) {
                    items[i].classList.remove('d-none'); // Mostrar (Bootstrap class)
                } else {
                    items[i].classList.add('d-none');    // Ocultar (Bootstrap class)
                }
            }
        }
    </script>
</body>
</html>