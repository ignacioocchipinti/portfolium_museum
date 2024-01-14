

<?php 

    $host_db = "localhost"; 
    $usuario_db = "root"; 
    $clave_db = ""; 
    $nombre_db = "portfolio_museum_db"; 
     
    $conn = new mysqli($host_db, $usuario_db, $clave_db, $nombre_db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
?>
