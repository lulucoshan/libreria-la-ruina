<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/fondocool.css" />
    <title>P.O.S 3000 libreria la ruina! </title>
  </head>

  <!--barra de navegación copiable para cualquier pagina del sistema exepto el login-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="../imgs/logo.png" width="200"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
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
    <div class="container mt-5">
    <div class="row justify-content-center">

        <!-- TARJETA 1 -->
        <div class="col-md-3">
            <a href="inventarioLibs.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-4 card-menu">
                    <img src="../imgs/inventario.png" class="card-img-top img-fluid" alt="Inventario">
                    <div class="card-body" style="background:#DDBA3F;">
                        <h5 class="card-title text-white">Inventario</h5>
                        <p class="card-text text-white">Administra el inventario de la librería</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- TARJETA 2 -->
        <div class="col-md-3">
            <a href="venta.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-4 card-menu">
                    <img src="../imgs/ventas.png" class="card-img-top img-fluid" alt="Venta">
                    <div class="card-body" style="background:#DDBA3F;">
                        <h5 class="card-title text-white">Realizar venta</h5>
                        <p class="card-text text-white">Realizar una venta</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- TARJETA 3 -->
        <div class="col-md-3">
            <a href="reportes.php" class="text-decoration-none">
                <div class="card shadow-sm border-0 mb-4 card-menu">
                    <img src="../imgs/estadisticas.png" class="card-img-top img-fluid" alt="Reportes">
                    <div class="card-body" style="background:#DDBA3F;">
                        <h5 class="card-title text-white">Reportes</h5>
                        <p class="card-text text-white">Ver reportes de ventas</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
  </body>
  <script src="../js/bootstrap.bundle.min.js"></script>
</html>