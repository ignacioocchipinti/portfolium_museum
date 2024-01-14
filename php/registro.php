<?php

include('acceso_db.php');

if (isset($_POST['enviar'])) {
    if ($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) {
        echo "Los passwords ingresados no coinciden. <a href='javascript:history.back();'>Reintentar</a>";
    } else {

        $usuario_nombre = $_POST['usuario_nombre'];
        $usuario_apellido = $_POST['usuario_apellido'];
        $usuario_username = $_POST['usuario_username'];
        $usuario_email = $_POST['usuario_email'];
        $usuario_clave = $_POST['usuario_clave'];
        $usuario_edad = $_POST['usuario_edad'];
        $usuario_nacionalidad = $_POST['usuario_nacionalidad'];

        $sql = "SELECT usuario_nombre FROM usuarios_pm WHERE usuario_nombre='" . $usuario_nombre . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "El nombre usuario elegido ya ha sido registrado anteriormente. <a href='javascript:history.back();'>Reintentar</a>";
        } else {
            $usuario_clave = md5($usuario_clave);

            $reg = "INSERT INTO usuarios_pm (usuario_nombre, usuario_apellido, usuario_username, usuario_email, usuario_clave, usuario_edad, usuario_nacionalidad, usuario_freg) VALUES ('" . $usuario_nombre . "', '" . $usuario_apellido . "','" . $usuario_username . "','" . $usuario_email . "','" . $usuario_clave . "','" . $usuario_edad . "','" . $usuario_nacionalidad . "', NOW())";

            if ($conn->query($reg) === TRUE) {
                echo "Datos ingresados correctamente. Ya puedes acceder con tu usuario y password a las paginas para usuarios";

?>
                <html>
                <a href="index.php">Login</a>

                </html>
    <?php
            } else {
                echo "ha ocurrido un error y no se registraron los datos.";
            }
        }
    }
} else {
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
        <title>PM | Register</title>
    </head>

    <body>
    <body>
    <section class="login-register d-flex full-height">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="row lr">
                <div class="col-12 col-lg-6 p-0 d-lg-block d-md-none d-sm-none d-none" id="mouse-portrait-holder">
                </div>
                <div class="col-12 col-lg-6 p-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <h2>Crea tu cuenta</h2>
                            <input type="text" name="usuario_nombre" maxlength="30" placeholder="Nombre"
                                title="30 caracteres sin espacio, solo letras" pattern="[a-zA-Z]+" required class="input-t-text mb-3" />
                            <input type="text" name="usuario_apellido" maxlength="30" placeholder="Apellido"
                                title="30 caracteres sin espacio, solo letras" pattern="[a-zA-Z]+" required class="input-t-text mb-3" />
                            <input type="text" name="usuario_username" maxlength="15" placeholder="Usuario"
                                title="15 caracteres sin espacio, solo letras" pattern="[a-zA-Z]+" required class="input-t-text mb-3" />
                            <input type="email" name="usuario_email" maxlength="50" placeholder="Email" required class="input-t-text mb-3" />
                            <input type="password" name="usuario_clave" maxlength="15"
                                pattern="[a-zA-Z][a-zA-Z0-9-_\.]+" placeholder="Contraseña" required class="input-t-text mb-3" />
                            <input type="password" name="usuario_clave_conf" maxlength="15"
                                pattern="[a-zA-Z][a-zA-Z0-9-_\.]+" placeholder="Confirmar contraseña" required class="input-t-text mb-3" />
                            <input type="number" name="usuario_edad" maxlength="3" min="0" max="120" placeholder="Edad"
                                required class="input-t-text mb-3" />
                            <input type="text" name="usuario_nacionalidad" maxlength="50" placeholder="Nacionalidad"
                                title="50 caracteres sin espacio, solo letras" pattern="[a-zA-Z]+" required class="input-t-text mb-3" />
                            <input type="submit" name="enviar" value="Registrarme" class="submit-btn mb-3" />
                            <p class="normal-link">Ya tenes una cuenta? <a href="index.php">Inicia sesión</a></p>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</body>
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


            let strokeWeightRandom = random(4);
            let color = "";
            stroke(255, 130, 0);
            strokeWeight(strokeWeightRandom);
            noFill();

            if (mouseIsPressed) {
                line(mouseX, mouseY, pmouseX + 80 / 20, pmouseY + 60);

            }
            fill(255, 130, 0);
            image(logo, width - 80, height - 40, 100, 25);

        }
    </script>

    </html>

<?php
}
?>