<?php
    include("conexiones/conexion.php");

   if(isset($_POST["register"])){

    if (strlen($_POST["name"]) >= 1 &&
    strlen($_POST["login"]) >= 1 &&
    strlen($_POST["pass"]) >= 1 ){

        $name=trim($_POST["name"]);
        $login=trim ($_POST["login"]);
        $pass=trim ($_POST["pass"]);
        $consulta="INSERT INTO usuario( nombre, login, pass) VALUES ('".$name."','".$login."','".$pass."')";
        $resultado=mysqli_query($conn,$consulta);

        if($resultado){
            ?>
                <h3 class="ok">Te has registardo exitosamente.</h3>
            <?php
        }else{
            ?>
                <h3 class="bad">Has tenido un error.</h3>
            <?php

        }
    }else{
        ?>
            <h3 class="bad">Por favor complete los campos correctamente.</h3>
            <?php
        }
    }
?>