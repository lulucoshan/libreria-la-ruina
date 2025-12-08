<?php
// Datos simulados (PHP)
$libros = [
    ["id" => 1, "titulo" => "libro 1", "desc" => "lorem ipsum"],
    ["id" => 2, "titulo" => "libro 2", "desc" => "ipsum ipsum"],
    ["id" => 3, "titulo" => "libro 3", "desc" => "blah blah"],
    ["id" => 4, "titulo" => "libro 4", "desc" => "blah"],
    ["id" => 5, "titulo" => "libro 1", "desc" => "lorem ipsum"],
    ["id" => 6, "titulo" => "libro 2", "desc" => "ipsum ipsum"],
    ["id" => 7, "titulo" => "libro 3", "desc" => "blah blah"],
    ["id" => 8, "titulo" => "libro 4", "desc" => "blah"],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema P.O.S - Local</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* ESTILOS PERSONALIZADOS (Lo que Bootstrap no hace por defecto) */
        body {
            background: linear-gradient(135deg, #bdc3c7 0%, #2c3e50 100%);
            min-height: 100vh;
        }

        /* Navbar personalizada para parecerse a la imagen */
        .navbar {
            background-color: #f8f9fa;
            border-bottom: 3px solid #dee2e6;
            padding: 0.5rem 1rem;
        }

        .logo-box {
            background-color: #e1c340;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            border-radius: 4px;
            margin-right: 10px;
        }

        .brand-text small {
            color: #6c7ae0;
            font-size: 0.75rem;
            display: block;
            margin-top: -5px;
        }

        /* Estilo de las tarjetas (Cards) */
        .custom-card {
            background-color: #dfbf43; /* Amarillo Mostaza */
            border: none;
            color: white;
            transition: transform 0.2s;
            height: 280px;
            cursor: pointer;
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* Input de búsqueda estilo Bootstrap pero personalizado */
        .search-container {
            position: relative;
            max-width: 300px;
        }
        
        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
        }

        .form-control-search {
            padding-left: 35px; /* Espacio para el icono */
            background-color: #ecf0f1;
            border: none;
        }

        /* SVG Placeholder */
        .placeholder-svg {
            width: 100px;
            height: 80px;
            fill: #4b6a82;
        }
        
        .card-img-area {
            flex-grow: 1;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 20px;
        }
    </style>
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
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control form-control-search" id="searchInput" placeholder="Search..." onkeyup="filterBooks()">
                </div>
                <i class="fas fa-cart-plus text-white fs-2 cursor-pointer"></i>
            </div>
        </div>

        <div class="row g-4" id="bookGrid">
            <?php foreach ($libros as $libro): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 book-item"> 
                    <div class="card custom-card h-100 p-3">
                        <h5 class="card-title book-title"><?php echo $libro['titulo']; ?></h5>
                        <p class="card-text small op-75"><?php echo $libro['desc']; ?></p>
                        
                        <div class="card-img-area">
                            <svg class="placeholder-svg" viewBox="0 0 24 24">
                                <circle cx="18" cy="6" r="3" fill="#4b6a82"/>
                                <path d="M1 18 L8 10 L14 16 L23 18 V20 H1 Z" fill="#4b6a82"/>
                                <path d="M10 18 L16 12 L23 19" fill="#4b6a82"/>
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>

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