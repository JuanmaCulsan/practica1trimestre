<?php
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
        $login="";
        if (($login=="afaf")) {
            
            $login=$_GET['loggin'];
            $pass=$_GET['pass'];
            $_SESSION['username']=$login;
            $_SESSION['password']=$pass;
            $sql="SELECT admin FROM usuario WHERE login= $login AND pass= $pass";

            $res=mysqli_query($conn,$sql);

            if($res){
                if(mysqli_num_rows($res)>0){
                    while($rows = mysqli_fetch_assoc($res)){
                        $esAdmin = $rows['admin'];
                    }
                }
            }

            if ($esAdmin==0) {
                
                header("location: http://localhost:81/pruebaclone/practica1trimestre/datos_usuario.php?loggin=$login&pass=$pass");
            }
        }
    ?>
    <?php if(session_status()==2):?>
    <div class="container">
        <div class="content">
            <form class="form" method="GET">
                <h1>¡Bienvenido!</h1>
                <input type="text" name="loggin" class="username" placeholder="login">
                <br>
                <input type="password" name="pass" class="username" placeholder="password">
                <input type="submit" class="submit" value="aceptar">
                <p>Eres nuevo/a <a href="index.php">pincha aqui</a>
            </form>
        </div>
    </div>
    <?php endif?>
</body>
</html>