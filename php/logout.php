
<?php
    
    session_start(); 
    include('acceso_db.php'); 
    
    if(isset($_SESSION['usuario_username'])) { 
        
		session_destroy(); 
    
		header("Location: index.php"); 
    }else 
     { 
        echo "Operacion incorrecta.";
     }
      
?>


