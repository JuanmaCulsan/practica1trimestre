<?php
    require("header.php");
    require("conexiones/conexion.php");
?>
<?php
   

   if(isset($_POST["register"])){

    if (strlen($_POST["name"]) >= 1 &&
    strlen($_POST["login"]) >= 1 &&
    strlen($_POST["pass"]) >= 1 ){

        $name=trim($_POST["name"]);
        $login=trim ($_POST["login"]);
        $pass=trim ($_POST["pass"]);
        $repetido=false;

            if($repetido) {
                ?>
                    <h3 class="bad">El nombre del login ya existe.</h3>
                <?php
            }
            else{

                $consulta="INSERT INTO usuario( nombre, login, pass) VALUES ('".$name."','".$login."','".password_hash($pass,PASSWORD_DEFAULT)."')";//E: encriptamos la contraseña para poder guardarla en bbdd
                $resultado=mysqli_query($conn,$consulta);

                if($resultado){
                    ?>
                        <h3 class="ok">Te has registardo exitosamente.</h3>    
                    <?php //si te registras de forma exitosa, vas a la pagina datos_usuario de forma automatica, mandando los datos necesarios

                    $_SESSION['username']=$login;//creo la sesion, ya que no pasa por el login
                    $_SESSION['password']=password_hash($pass,PASSWORD_DEFAULT);

                    header("location: http://localhost:81/cloneSucio/practica1trimestre/datos_usuario.php?loggin=".$_POST['login'],PASSWORD_DEFAULT);
                }else{
                        ?>
                            <h3 class="bad">Has tenido un error.</h3>
                        <?php
            
                    }
            }
    }else{
        ?>
            <h3 class="bad">Por favor complete los campos correctamente.</h3>
            <?php
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registrar usuario</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="estilos/ccs_nuevo_usuario.css">


</head>
<body>
    <form method="post">

        <h1>Registrate</h1>
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="login" placeholder="Nombre de login">
        <input type="password" name="pass" placeholder="Contraseña">
        <input type="submit" name="register">
    </form>
</body>




</html>