<?php
    if (isset($_GET['loggin'])) { //compruebo si hay un usuario para poder usar la cookie
        $fech=$_COOKIE['fecha_'.$_GET['loggin']];//guardo la informacion de la cookie en una variable
    }
    
    require "header.php";
    require "conexiones/conexion.php";
    require ("funciones/loggin_funciones.php");
    //hola
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
        if (isset($_GET['loggin']))://para saber cuando entro por primera vez, compruebo si se ha mandado el username, en caso de que se inicie sesion entro en este if
            $login=$_GET['loggin'];//guardo la informacion que ha mandado el usuario
            $pass=($_GET['pass']);
            $esAdmin=-1;//variable para identificar si el usuario es admin

            
        
        $logearse = loggearse($_GET['loggin'],$_GET['pass']);
        $_SESSION['ultConn']=$fech;
        $_SESSION['username']=$login;//creo la sesion
        $_SESSION['password']=$pass;
        //en el siguiende header:location se manda al usuario a una pagina dependiendo del if anterior, en caso de que ocurra un error se le mandará de nuevo al login
        header("location: http://localhost:81/pruebaclone/practica1trimestre/$logearse");
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