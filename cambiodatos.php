<?php
    require("header.php");
    require('conexiones/conexion.php');

    $id=$_GET['id_usu'];

    if (!isset($_SESSION['username'])) {
        header("Location: logging.php ");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if(($_POST['nombre']==null)||($_POST['login']==null)||($_POST['pass']==null)){
            echo "rellene los campos";
        }
        else{
            $sql2 = "UPDATE usuario 
                SET nombre='".$_POST['nombre']."', login='".$_POST['login']."', pass='".password_hash($_POST['pass'],PASSWORD_DEFAULT)."' 
                WHERE id_usu='".$id."'";
     
            $results2 = mysqli_query($conn, $sql2);
     
            if ($results2 === false) {
     
            echo mysqli_error($conn);
     
            } else {
                header("location: http://localhost:81/cloneSucio/practica1trimestre/datos_usuario.php?id_usu=$id");
                $id = mysqli_insert_id($conn);
                //echo "Inserted record with ID: $id";
            }
        }  
    } 
    //$contra = $_GET['pass'];
    //$log = $_GET['login'];
  
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
<div class="container">
        <div class="content">
            <form class="form" method="POST">
                <label for="">NOMBRE</label>
                <input type="text" name="nombre">
                <br>
                <label for="">CONTRASEÑA</label>
                <input type="text" name="pass">
                <br>
                <label for="">LOGIN</label>
                <input type="text" name="login">
                <br>
                <input type="hidden" value=<?= $id?> name="id_usu">
                <input type="submit" class="submit">
            </form>
        </div>
    </div>
</body>
</html>