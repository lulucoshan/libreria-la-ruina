<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/fondologs.css">
</head>
<html>
    <body>
        <div class="container mt-3 p-3 border rounded w-25 bg-white">
            <h1 class="text-center p-3">Registrar un usuario nuevo al sistema C.R.U.D</h1>
            <form method="post" action="encriptar.php">
                <div class="mb-3">
                    <label for=nuNombre class="input-label">Nuevo nombre usuario</label>
                    <input type="text" id="nuNombre" name="ussr1" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="psswrd" class="input-label">contraseña</label><br>
                    <input type="password" id="psswrd" name="newpssw" class="form-control"><br>
                </div>
                <button type="submit" class="btn btn-primary">crear usuario</button>
            </form>
        </div>
    </body>
</html>