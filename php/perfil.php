<?php

session_start();
include('acceso_db.php');

if (isset($_SESSION['usuario_username'])) {
    $usuario_actual = $_SESSION['usuario_username'];

    $query2 = "SELECT usuario_nombre, usuario_apellido, usuario_email, usuario_edad, usuario_nacionalidad FROM usuarios_pm  WHERE usuario_username = '$usuario_actual'";
    $result = mysqli_query($conn, $query2) or die(mysqli_error($conn));

    while ($row = mysqli_fetch_assoc($result)) {
        $usuario_nombre =  $row['usuario_nombre'];
        $usuario_apelllido = $row['usuario_apellido'];
        $usuario_email = $row['usuario_email'];
        $usuario_edad = $row['usuario_edad'];
        $usuario_nacionalidad = $row['usuario_nacionalidad'];
    }
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
        <title>PM - Perfil</title>
    </head>
    <?php

    if (isset($_REQUEST['subir-foto'])) {
        $nombre_obra = $_REQUEST['titulo'];
        $tipo_obra = $_POST['tipo_de_obra'];
        $nombre_imagen = $_FILES['obra']['name'];
        $extension_imagen = explode('.', $nombre_imagen);
        $extension = end($extension_imagen);
        $temporal = $_FILES['obra']['tmp_name'];
        $carpeta = '../assets/obras/s1/' . $usuario_actual;
        if (!file_exists('../assets/obras/s1/' . $usuario_actual)) {
            mkdir('../assets/obras/s1/' . $usuario_actual, 0777, true);
        }
        $ruta_obra = $carpeta . '/' . $nombre_imagen;
        move_uploaded_file($temporal, $carpeta . '/' . $nombre_obra . '.' . $extension);
        $usuario_username = $_SESSION['usuario_username'];
        $query = "INSERT INTO obras_s1 (titulo_obra, ruta_obra, usuario_username, extension_obra, tipo_de_obra) VALUES ('" . $nombre_obra . "', '" . $ruta_obra . "', '" . $usuario_username . "', '" . $extension . "', '" . $tipo_obra . "')";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    }

    ?>

    <body>
        <section class="menu full-height d-none d-sm-none d-md-flex align-items-center">
            <div class="container" style="height: 60%;">
                <div class="row">
                    <div class="header-title mb-md-5">
                        <img src="../assets/logo.png" alt="logo" style="width: 250px;">
                    </div>
                    <a href="#mi-perfil" class="card-menu col-lg-6 d-none d-sm-none d-md-block">
                        <div>
                           <h2>Ir a mi</h2>
                           <h2>perfil</h2>
                        </div>
                    </a>
                    <a href="#mi-museo" class="card-menu col-lg-6 d-none d-sm-none d-md-block">
                        <div>
                        <h2>Ir a mi</h2>
                        <h2>perfil</h2>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="mi-perfil full-height d-flex align-items-center" id="mi-perfil">
            <div class="container">
                <div class="row">
                    <div class="header-title perfil mb-md-5 col-lg-12 d-none d-sm-none d-md-block">
                        <h2 class="mt-2 h1 fw-bold">Mi perfil</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="datos-usuario d-flex col-lg-4 col-sm-12">
                        <img src="../assets/profile-pic.png" alt="pp" class="img-fluid card-img mb-lg-5">
                        <div class="card-body">
                            <h2><?= $usuario_actual ?></h2>
                            <p><?= $usuario_nombre ?></p>
                            <p><?= $usuario_apelllido ?></p>
                            <p><?= $usuario_email ?></p>
                            <p><?= $usuario_edad ?></p>
                            <p><?= $usuario_nacionalidad ?></p>
                            <p class="normal-link cerrar-sesion"><a href="logout.php">Salir</a></p>
                        </div>

                    </div>
                    <div class="subir-obras col-lg-8 col-sm-12">
                        <h2>Subir obras</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="text" name="titulo" placeholder="Nombre de la obra" class="input-t-text mb-3" id="in_nombreObra" required>
                            <select name="tipo_de_obra" id="" class="input-t-text mb-3">
                                <option value="#">Elegir tipo de obra</option>
                                <option value="afiche">Afiche</option>
                                <option value="fotografia">Fotografía</option>
                                <option value="dibujo">Dibujo</option>
                            </select>
                            <input type="file" name="obra" class="input-t-text mb-3 p-1" id="in_archivoObra" required>
                            <br>
                            <input type="submit" name="subir-foto" value="Subir imagen" class="submit-btn mb-3" id="btn">
                            <br>
                            <?php
                            if ($result) {
                                echo "<p>Subida exitosa</p>";
                            } else {
                                echo "<p>Hubo un error</p>";
                            }
                            ?>
                        </form>
                        <div class="mis-obras">
                            <h2>Editar mis obras</h2>
                            <form action="" method="post">
                                <select name="ver-mis-obras" id="visorDeObras" class="input-t-text mb-3">
                                    <option value="#">- seleccionar obra -</option>
                                    <?php
                                    $query5 = "SELECT id, titulo_obra, extension_obra FROM obras_s1 WHERE usuario_username = '$usuario_actual'";
                                    $res = $conn->query($query5);
                                    $obras = array();
                                    $cont = 0;

                                    while ($row = $res->fetch_assoc()) {
                                        $id_obra = $row['id'];
                                        $n_obra = $row['titulo_obra'] . ".";
                                        $ext_obra =  $row['extension_obra'];

                                        $path = $n_obra . $ext_obra;
                                        array_push($obras, $path);
                                    ?>
                                        <option value="<?php echo $id_obra ?>"><?php echo substr($n_obra, 0, -1) ?></option>
                                    <?php
                                    }
                                    if (isset($_REQUEST['eliminar-foto'])) {
                                        $seleccion = $_POST['ver-mis-obras'];
                                        $eliminarSeleccion = "DELETE FROM obras_s1 WHERE id = '$seleccion'";
                                        $resEliminar = mysqli_query($conn, $eliminarSeleccion) or die(mysqli_error($conn));
                                    }

                                    ?>

                                    <input type="submit" name="eliminar-foto" value="Eliminar" class="submit-btn" id="btn-b">

                                </select>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <section class="mi-museo full-height d-none d-sm-none d-md-flex align-items-center" id="mi-museo">
            <div class="container">
                <div class="row">
                    <div class="header-title perfil mb-md-5 col-lg-12 d-none d-sm-none d-md-block">
                        <h2 class="mt-2 h1 fw-bold ps-4">Mi museo</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="contenedor-museo" id="contenedor-museo">

                    </div>
                </div>
            </div>
        </section>

        <script>
            if (window.history.replaceState) { // verificamos disponibilidad
                window.history.replaceState(null, null, window.location.href);
            }

            <?php
            //Este paso sirve para cargar un array de php en un array de javascript.
            //De esta manera luego podemos utilizarlo dentro de p5.js
            $js_array = json_encode($obras);
            echo "var javascript_array = " . $js_array . ";\n";
            ?>

            let usuario_actual = <?php echo json_encode($usuario_actual); ?>;

            let img = [];

            var numBalls = javascript_array.length;

            ////////////////////////////////////////////////////////////////////// SKETCH P5JS

            // grilla
            let canvasDiv = document.getElementById('contenedor-museo');
            let width = canvasDiv.offsetWidth;
            let height = canvasDiv.offsetHeight;

            let col1 = 0;
            let col2 = width / 12;
            let col3 = col2 * 2;
            let col4 = col3 + col2;
            let col5 = col3 * 2;
            let col6 = col5 + col2;
            let col7 = width / 2;
            let col8 = col7 + col2;
            let col9 = col8 + col2;
            let col10 = col9 + col2;
            let col11 = col10 + col2;
            let col12 = col11 + col2;

            let row1 = 0;
            let row2 = height / 6;
            let row3 = row2 * 2;
            let row4 = height / 2;
            let row5 = row4 + row2;
            let row6 = row5 + row2;

            let tamañoPj = 100;
            let radioPj = 40;

            // numero de escena
            let numeroDeEscena = 1;

            // imagenes escena 1
            let bg_escena_1;
            let edificio_escena1;
            let personaje;
            let acceso_e1;

            // imagenes escena 2
            let bg_escena_2;

            // imagenes sala 1
            let bg_sala_1;
            let obra1_s1;

            // letiables de movimiento e1
            let posXpersonajeE1 = 80;
            let posYpersonajeE1 = row6;
            let velocidadPersonaje = 10;

            // letiables de movimiento e2
            let posXpersonajeE2 = col3;
            let posYpersonajeE2 = row4 - radioPj;






            function preload() {

                for (var i = 0; i < numBalls; i++) {

                    img[i] = loadImage('../assets/obras/s1/' + usuario_actual + '/' + javascript_array[i]);

                }

                //  ================================================================================ load imgs escena1
                bg_escena_1 = loadImage('../assets/escena_1/bg_escena_1.jpg');
                edificio_escena1 = loadImage('../assets/escena_1/edificio_escena_1.png');
                acceso_e1 = loadImage('../assets/escena_1/acceso.png');
                personaje = loadImage('../assets/escena_1/Pj.png');

                //  ================================================================================ load imgs escena2
                bg_escena_2 = loadImage('../assets/escena_2/bgescena2.jpg');

                //  ================================================================================ load imgs sala 1
                bg_sala_1 = loadImage('../assets/sala_1/bg_sala_1.jpg');


            }



            function setup() {
                let canvasDiv = document.getElementById('contenedor-museo');
                let width = canvasDiv.offsetWidth;
                let height = canvasDiv.offsetHeight;
                let veintePorCientoHeight = height * 30 / 100;
                let sketchCanvas = createCanvas(width, height);
                console.log(sketchCanvas);
                sketchCanvas.parent("contenedor-museo");
                background(0);
                imageMode(CENTER);
            }

            function draw() {

                switch (numeroDeEscena) {
                    case 1:
                        escena1();
                        break;
                    case 2:
                        escena2();
                        break;
                    case 3:
                        sala1();
                        break;
                    case 4:
                        sala2();
                        break;
                    case 5:
                        sala3();
                        break;
                }

                console.log('nro de escena: ' + numeroDeEscena); //545 595
            }

            //  ======================================================================================================================= escena1

            function escena1() {

                //  ================================================================================ keyPressed escena1
                if (keyIsPressed) {
                    if (key == 'a') {
                        posXpersonajeE1 = posXpersonajeE1 - velocidadPersonaje;
                        if (posXpersonajeE1 < 0) {
                            posXpersonajeE1 = width;
                        }
                    } else if (key == 'd') {
                        posXpersonajeE1 = posXpersonajeE1 + velocidadPersonaje;
                        if (posXpersonajeE1 > width) {
                            posXpersonajeE1 = 0;
                        }
                    } else if (key == 'w') {
                        posYpersonajeE1 = posYpersonajeE1 - velocidadPersonaje;
                        if (posYpersonajeE1 < row6 - (tamañoPj - radioPj * 2)) {
                            posYpersonajeE1 = row6 - (tamañoPj - radioPj * 2);
                        }
                    } else if (key == 's') {
                        posYpersonajeE1 = posYpersonajeE1 + velocidadPersonaje;
                        if (posYpersonajeE1 > height - radioPj) {
                            posYpersonajeE1 = height - radioPj;
                        }
                    }


                }

                //  ================================================================================ draw de imgs
                image(bg_escena_1, width / 2, height / 2, width, height);
                image(edificio_escena1, width / 2, height / 2, width, height);
                image(acceso_e1, col7, row6 + (row2 / 6 + 2), col3, 48);
                image(personaje, posXpersonajeE1, posYpersonajeE1, tamañoPj, tamañoPj);


                // ================================================================================ entrada al museo
                if (posXpersonajeE1 > col6 && posXpersonajeE1 < col8 && posYpersonajeE1 < row6 + (48 - radioPj)) {
                    numeroDeEscena = 2;
                    posXpersonajeE1 = 80;
                    posYpersonajeE1 = row6;
                }
            }




            //  ======================================================================================================================= escena2
            function escena2() {



                //  ================================================================================ keyPressed escena1
                if (keyIsPressed) {
                    if (key == 'a') {
                        posXpersonajeE2 = posXpersonajeE2 - velocidadPersonaje;
                        if (posXpersonajeE2 < col2) {
                            posXpersonajeE2 = col2;
                        }
                    } else if (key == 'd') {
                        posXpersonajeE2 = posXpersonajeE2 + velocidadPersonaje;
                        if (posXpersonajeE2 > col12) {
                            posXpersonajeE2 = col12;
                        }
                    } else if (key == 'w') {
                        posYpersonajeE2 = posYpersonajeE2 - velocidadPersonaje;
                        if (posYpersonajeE2 < row2 - radioPj) {
                            posYpersonajeE2 = row2 - radioPj;
                        }
                    } else if (key == 's') {
                        posYpersonajeE2 = posYpersonajeE2 + velocidadPersonaje;
                        if (posYpersonajeE2 > row6 - radioPj) {
                            posYpersonajeE2 = row6 - radioPj;
                        }
                    }
                }

                if (posXpersonajeE2 < col3 - (col2 / 2) && posYpersonajeE2 > row3 && posYpersonajeE2 < row5 - radioPj) {
                    numeroDeEscena = 1;
                    posXpersonajeE2 = col3;
                    posYpersonajeE2 = row4 - radioPj;
                } else if (posXpersonajeE2 > col6 && posXpersonajeE2 < col8 && posYpersonajeE2 < row2 + (row2 / 2 - radioPj)) {
                    numeroDeEscena = 3;
                } else if (posXpersonajeE2 > col11 + (col2 / 2) && posYpersonajeE2 > row3 - radioPj && posYpersonajeE2 < row5 - radioPj) {
                    numeroDeEscena = 4;
                } else if (posXpersonajeE2 > col6 && posXpersonajeE2 < col8 && posYpersonajeE2 > row5 + (row2 / 2 - radioPj)) {
                    numeroDeEscena = 5;
                }

                image(bg_escena_2, width / 2, height / 2, width, height);
                image(personaje, posXpersonajeE2, posYpersonajeE2, 100, 100);
                console.log(posXpersonajeE2, posYpersonajeE2);

            }

            //  ======================================================================================================================= sala1
            function sala1() {

                image(bg_sala_1, col7, row3, col12 + col2, row6 + row5);

                let imgWidth = 300;
                let imgHeight = 180;
                let posX = col3;
                let intervaloX = col5;
                let posXOriginal = (width / 3) / 2;
                let posY = row2 + (row2 / 2);

                if (width <= 1200) {
                    posY = 100;
                    imgWidth = 250;
                    imgHeight = 160;
                }

                for (let i = 0; i < numBalls; i++) {

                    if(i < 6) {
                        image(img[i], posX, posY, imgWidth, imgHeight);
                    }

                    posX = posX + intervaloX;

                    if (posX > col11) {
                        posX = posXOriginal;
                        posY = posY + (imgHeight + (imgHeight / 3));
                    }

                }

                if (keyIsPressed) {
                    if (key == 'b' || key == 'B' && numeroDeEscena == 3) {
                        numeroDeEscena = 2;
                        posXpersonajeE2 = col3;
                        posYpersonajeE2 = row4 - radioPj;
                    }

                }
            }

            function sala2() {


                image(bg_sala_1, width / 2, height / 2, width, height);

                imgWidth = 300;
                imgHeight = 180;
                posX = (width / 3) / 2;
                posXOriginal = (width / 3) / 2;
                intervaloX = width / 3;
                posY = 180;

                if (width <= 1200) {
                    posY = 100;
                    imgWidth = 250;
                    imgHeight = 160;
                }
                
                for (let i = 6; i < numBalls; i++) {

                    image(img[i], posX, posY, imgWidth, imgHeight);

                    posX = posX + intervaloX;

                    if (posX > width - ((width / 3) / 2)) {
                        posX = posXOriginal;
                        posY = posY + (imgHeight + (imgHeight / 3));
                    }

                    if(i === 6)
                    {
                    
                    }
                    
                }

                if (keyIsPressed) {
                    if (key == 'b' || key == 'B' && numeroDeEscena == 4) {
                        numeroDeEscena = 2;
                        posXpersonajeE2 = col3;
                        posYpersonajeE2 = row4 - radioPj;
                    }

                }
            }

            function sala3() {


                image(bg_sala_1, width / 2, height / 2, width, height);

                imgWidth = 300;
                imgHeight = 180;
                posX = (width / 3) / 2;
                posXOriginal = (width / 3) / 2;
                intervaloX = width / 3;
                posY = 180;

                if (width <= 1200) {
                    posY = 100;
                    imgWidth = 250;
                    imgHeight = 160;
                }

                for (let i = 12; i < numBalls; i++) {

                    image(img[i], posX, posY, imgWidth, imgHeight);

                    posX = posX + intervaloX;

                    if (posX > width - ((width / 3) / 2)) {
                        posX = posXOriginal;
                        posY = posY + (imgHeight + (imgHeight / 3));
                    }

                }

                if (keyIsPressed) {
                    if (key == 'b' || key == 'B' && numeroDeEscena == 5) {
                        numeroDeEscena = 2;
                        posXpersonajeE2 = col3;
                        posYpersonajeE2 = row4 - radioPj;
                    }

                }
            }

            function grid() {
                stroke(255, 0, 0);
                strokeWeight(1);
                // cols
                line(col1, 0, col1, height);
                line(col2, 0, col2, height);
                line(col3, 0, col3, height);
                line(col4, 0, col4, height);
                line(col5, 0, col5, height);
                line(col6, 0, col6, height);
                line(col7, 0, col7, height);
                line(col8, 0, col8, height);
                line(col9, 0, col9, height);
                line(col10, 0, col10, height);
                line(col11, 0, col11, height);
                line(col12, 0, col12, height);

                //rows
                line(0, row1, 0, row1);
                line(0, row2, width, row2);
                line(0, row3, width, row3);
                line(0, row4, width, row4);
                line(0, row5, width, row5);
                line(0, row6, width, row6);
            }
        </script>


    </body>

    </html>




<?php



} else {
    echo "Estas accediendo a una pagina restringida, para ver su contenido debes estar registrado.<br />
        <a href='login.php'>Ingresar</a> / <a href='registro.php'>Regitrarme</a>";
}

?>