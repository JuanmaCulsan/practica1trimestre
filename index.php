<?php
    require("header.php");
    require("conexiones/conexion.php");
    require("funciones/index_funciones.php");
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
                nuevo_usuario($_POST["name"],$_POST["login"],$_POST["pass"]);
                $_SESSION['username']=$_POST["login"];//creo la sesion, ya que no pasa por el login
                $_SESSION['password']=password_hash($_POST["pass"],PASSWORD_DEFAULT);
                header("location: http://localhost:81/pruebaclone/practica1trimestre/datos_usuario.php?loggin=".$_POST['login'],PASSWORD_DEFAULT);
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