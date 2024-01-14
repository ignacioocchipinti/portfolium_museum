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

        <!-- Bootstrap 5.2 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <!-- Sora Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100;300;400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style.css">

        <script src="../js/p5.js"></script>
        <title>PM | Login</title>
    </head>

    <body>
        <section class="login-register d-flex full-height">
            <div class="container d-flex align-items-center justify-content-center">
                <div class="row lr">
                <div class="col-12 col-lg-6 p-0 d-lg-block d-md-none d-sm-none d-none" id="mouse-portrait-holder">
                    </div>
                    <div class="col-12 col-lg-6 p-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <form action="comprobar.php" method="post">
                                <img src="../assets/logo.png" alt="logo">
                                <input type="text" name="usuario_username" id="usuario" placeholder="Ingrese su usuario" class="input-t-text mb-3" required>
                                <input type="password" name="usuario_clave" id="contraseña" placeholder="Ingrese su contraseña" class="input-t-text mb-3" required>
                                <input type="submit" name="enviar" value="Ingresar" id="botonLogin" class="submit-btn mb-3">
                                <p class="normal-link">No tenes una cuenta? <a href="registro.php">Registrate</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>

    <script>
        //  ======================================================================================================================= setup

        let logo;

        function setup() {

            var canvasDiv = document.getElementById('mouse-portrait-holder');
            var width = canvasDiv.offsetWidth;
            var height = canvasDiv.offsetHeight;
            var sketchCanvas = createCanvas(width, height);
            console.log(sketchCanvas);
            sketchCanvas.parent("mouse-portrait-holder");
            background(0);
            imageMode(CENTER);
            rectMode(CENTER);
        }

        function preload() {
            logo = loadImage('../assets/logo-light.png');

            
        }

        function draw() {



            let r = random(245, 255);
            let g = random(110, 120);
            let weightRandom = random(2);

            let tamañoForma = 10;

            noFill();
            stroke(r, g, 0);
            strokeWeight(weightRandom);

            if (mouseIsPressed) {

                ellipse(mouseX, mouseY, 30, 30);

            }

            fill(255, 130, 0);
            image(logo, width - 120, height - 60, 100, 25);
        }
    </script>

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