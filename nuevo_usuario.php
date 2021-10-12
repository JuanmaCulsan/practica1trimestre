<?php
    require("header.php");
    require("conexion.php");

    $n_usuario=['usuario'];
    $n_pass=['pass'];
    $n_loggin=['login'];
    $n_matricula=['matricula'];
    $n_marca=['marca'];
    $n_modelo=['modelo'];

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleNuevoUsuario.css">    
        <title>Document</title>
    </head>
    <body>
        <div class="container">
        <h2>¡Registrate!</h2>
            <div class="content">
                <form action="" method="GET">
                    <label for="">Nombre</label>
                    <input type="text" name="usuario">
                    <br>
                    <label for="">Nombre de usuario</label>
                    <input type="text" name="login">
                    <br>
                    <label for="">Contraseña</label>
                    <input type="text" name="pass">
                    <br>
                    <label for="">Matricula</label>
                    <input type="text" name="matricula">
                    <br>
                    <label for="">Marca</label>
                    <input type="text" name="marca">
                    <br>
                    <label for="">Modelo</label>
                    <input type="text" name="modelo">
                </form>
            </div>
        </div>
    </body>
    </html>
