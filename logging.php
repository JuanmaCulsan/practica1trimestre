<?php
    if (isset($_GET['loggin'])) {
        $fech=$_COOKIE['fecha_'.$_GET['loggin']];
    }
    
    require "header.php";
    require "conexiones/conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Document</title>
</head>
<body>

    <?php
        if (isset($_GET['loggin'])):
            
            $login=$_GET['loggin'];
            $pass=($_GET['pass']);
            $headerL="logging.php";
            $esAdmin=-1;
            
            $sql="SELECT login,pass,admin FROM usuario";
            $res0=mysqli_query($conn,$sql);
            if ($res0) {
                if (mysqli_num_rows($res0)>0) {
                    while($fils=mysqli_fetch_assoc($res0)){

                        if (($fils['login']==$login)) { 
                            if (password_verify($pass,$fils['pass'])) {

                                $_SESSION['username']=$login;
                                $_SESSION['password']=$pass;
                                $_SESSION['ultConn']=$fech;

                                $esAdmin=$fils['admin'];
    
                                if ($esAdmin==0) {
                                    
                                    $headerL="datos_usuario.php?loggin=$login&pass=".password_hash($pass,PASSWORD_DEFAULT);
                                }
                                else if ($esAdmin==1) {
                                    
                                    $headerL0="";
                                }
                            }
                        }
                    }
                }
            }
            header("location: http://localhost:81/cloneSucio/practica1trimestre/$headerL");
    ?>
    <?php else:?>
        <div class="container">
            <div class="content">
                <form class="form" method="GET">
                    <h1>¡Bienvenido!</h1>
                    <input type="text" name="loggin" class="username" placeholder="login" require>
                    <br>
                    <input type="password" name="pass" class="username" placeholder="password" require>
                    <input type="submit" class="submit" value="aceptar">
                    <p>Eres nuevo/a <a href="index.php">pincha aqui</a>
                </form>
            </div>
        </div>
    <?php endif?>
</body>
</html>