<?php
    $db_host = "localhost";
    $db_name = "practica1php";
    $db_user = "root";
    $db_pass = "";
    
    //esto es para hacer la conexión
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
 
    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }
?>