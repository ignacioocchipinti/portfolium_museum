<?php

session_start();
include('acceso_db.php');

if (isset($_SESSION['usuario_username'])) {
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
        <!-- <link rel="stylesheet" href="../styles.css"> -->
        <link rel="stylesheet" href="../css/style.css">

        <script src="../js/p5.js"></script>

        <title>PM | Mi perfil</title>
    </head>

    <?php

    if (isset($_REQUEST['subir-foto'])) {
        $nombre_obra = $_REQUEST['titulo'];
        $nombre_imagen = $_FILES['obra']['name'];
        $temporal = $_FILES['obra']['tmp_name'];
        $carpeta = 'assets/sala_1/obras_subidas';
        $ruta_obra = $carpeta . '/' . $nombre_imagen;
        move_uploaded_file($temporal, $carpeta . '/' . $nombre_imagen);
        $usuario_username = $_SESSION['usuario_username'];

        $query = "INSERT INTO obras_s1 (titulo_obra, ruta_obra, usuario_username) VALUES ('" . $nombre_obra . "', '" . $ruta_obra . "', '" . $usuario_username . "')";
        $execute = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if ($execute) {
            echo "Subida exitosa";
        } else {
            echo "Hubo un error";
        }
    }

    ?>

    <body>
        <h2>Hola <strong><?= $_SESSION['usuario_username'] ?></strong> | <a href="logout.php">Salir</a></h2>

        <form action="" method="post" enctype="multipart/form-data">
            <label>Nombre de la obra: </label>
            <br>
            <input type="text" name="titulo" required>
            <br>
            <label>Seleccione su obra</label>
            <br>
            <input type="file" name="obra" required>
            <br>
            <button type="submit" name="subir-foto">Subir imagen</button>
        </form>

    </body>

    </html>

    <form action="perfil_usuario.php">
        <label for="nombreObra">Ingrese el nombre de la obra</label>
        <input type="text" name="nombreObra" id="nombreObra">
        <input type="submit" value="Buscar info" name="buscar-info">
        <input type="text" name="nombreUsuario" id="nombre_usuario" disabled style="background-color: white;">

    </form>

    <?php
    if ($_SESSION['usuario_username'] == "admin") {
        echo "<p>Eres uno de los administradores.</p>";
        echo "<p>Aca vas a poder seleccionar que obras van a estar en el museo</p>";
        $nombre_usuario;
        if (isset($_REQUEST['buscar-info'])) {
            $nombreObra = $_REQUEST['nombreObra'];

            $sql = "SELECT usuario_username FROM obras_s1 WHERE titulo_obra = '$nombreObra'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            while ($row = mysqli_fetch_array($result)) {
                $nombre_usuario = $row['usuario_username'];
    ?>

                <script>
                    document.getElementById('nombre_usuario').value = "<?php echo $nombre_usuario; ?>";
                    document.getElementById('nombre_usuario2').value = "<?php echo $nombre_usuario; ?>";
                </script>

        <?php
            }
            if (isset($_REQUEST['mostrar-info'])) {
                $sql2 = "SELECT (usuario_nombre, usuario_apellido, usuario_edad, usuario_nacionalidad) FROM usuarios_pm WHERE usuario_username = '$usuario_username'";
                $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    
                while ($row = mysqli_fetch_array(($result2)))
                {
                    echo "<p>".$row['usuario_nombre']."</p>";
                    echo "<p>".$row['usuario_apellido']."</p>";
                    echo "<p>".$row['usuario_edad']."</p>";
                    echo "<p>".$row['usuario_nacionalidad']."</p>";

                }
            }
        }

        ?>
        <form action="perfil_usuario.php">

            <input type="submit" value="Mostrar info" name="mostrar-info">

        </form>

<?php

        
    }
} else {
    echo "Estas accediendo a una pagina restringida, para ver su contenido debes estar registrado.<br />
        <a href='login.php'>Ingresar</a> / <a href='registro.php'>Regitrarme</a>";
}
?>