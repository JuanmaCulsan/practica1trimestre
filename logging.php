<?php
    require "header.php";
    require "conexiones/conexion.php";

    $fech=$_COOKIE['fecha'];
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
            $pass=$_GET['pass'];
            $headerL="logging.php";
            $esAdmin=-1;

            $sql="SELECT login FROM usuario";
            $res0=mysqli_query($conn,$sql);
            if ($res0) {
                if (mysqli_num_rows($res0)>0) {
                    while($fils=mysqli_fetch_assoc($res0)){

                        if ($fils['login']==$login) {
                            
                            $_SESSION['username']=$login;
                            $_SESSION['password']=$pass;
                            $_SESSION['ultConn']=$fech;
                            $sql="SELECT * FROM usuario WHERE login= '$login' AND pass= '$pass'";

                            $results = mysqli_query($conn, $sql);

 
                            if ($results === false) {
                                echo mysqli_error($conn);
                            } else {
                                $recorrer = mysqli_fetch_all($results, MYSQLI_ASSOC);
                            }

                            foreach ($recorrer as $tabla) {
                                $esAdmin=$tabla['admin'];
                            }

                            if ($esAdmin==0) {
                                
                                $headerL="datos_usuario.php?loggin=$login&pass=$pass";
                            }
                            else if ($esAdmin==1) {
                                
                                $headerL0="";
                            }
                        }
                    }
                }
            }
            header("location: http://localhost:81/pruebaclone/practica1trimestre/$headerL");
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