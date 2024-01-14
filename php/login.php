<?php

session_start();
include('acceso_db.php');

if (empty($_SESSION['usuario_username'])) {

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">
        <title>Portfolio Museum | Login</title>
    </head>

    <body>
    <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <img src="assets/general/logo_min.png" alt="logo">
                    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Ir al museo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registro.php">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contacto</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <a href="login.php"><button class="btn">Login</button></a>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <section>
            <form action="comprobar.php" method="post">
                <div class="form-group">
                    <label for="usuario_username">Usuario</label>
                    <br>
                    <input type="text" name="usuario_username" id="usuario" placeholder="Ingrese su usuario" required>
                </div>
                <div class="form-group">
                    <label for="usuario_clave">Contraseña</label>
                    <br>
                    <input type="password" name="usuario_clave" id="contraseña" placeholder="Ingrese su contraseña" required>
                </div>
                <input type="submit" name="enviar" value="Ingresar">
                <br>
                <span>¿No sos miembro? <a href="registro.php">Registrarme</a></span>
            </form>
        </section>

    </body>

    </html>

<?php

} else {
?>
    <?php
    header("Location: perfil.php");
    ?>
<?php
}
?>