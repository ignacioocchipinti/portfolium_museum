
<?php 

    session_start(); 
    
	include('acceso_db.php'); 
    
	if(isset($_POST['enviar']))
    {  
        if(empty($_POST['usuario_username']) || empty($_POST['usuario_clave']))
        {
            echo "El usuario o el password no han sido ingresados. <a href='javascript:history.back();'>Reintentar</a>";
        }
        else
        {
            
                $usuario_username = $_POST['usuario_username'];
                $usuario_clave = $_POST['usuario_clave'];
            
                $usuario_clave = md5($usuario_clave);
            
                $sql = "SELECT usuario_id, usuario_username, usuario_clave FROM usuarios_pm WHERE usuario_username='".$usuario_username."' AND usuario_clave='".$usuario_clave."'";
                
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0)
                    {
                        
                        while($row = $result->fetch_assoc())
                            {
                    
                                $_SESSION['usuario_id'] = $row['usuario_id']; 
                                $_SESSION['usuario_username'] = $row["usuario_username"]; 
                                header("Location: login.php");

                            }
                    }
                else {
                        ?>
                        El usuario o la contrase�a ingresada no son correctas, <a href="login.php">Reintentar</a>
                        <?php
                     }
        }
    }else
    {
        header("Location: login.php");
    }
    
    
?>
