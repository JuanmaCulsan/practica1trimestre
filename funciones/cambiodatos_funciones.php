<?php

    function editar_usu($nom,$log,$passw,$idu){

                    
        require('conexiones/conexion.php');

        $sql2 = "UPDATE usuario 
        SET nombre='$nom', login='$log', pass='$passw' 
        WHERE id_usu='$idu'";

        $results2 = mysqli_query($conn, $sql2);

        if ($results2 === false) {

        echo mysqli_error($conn);

        } else {
            header("location: http://localhost:81/cloneSucio/practica1trimestre/datos_usuario.php?loggin=$log");
            $id = mysqli_insert_id($conn);
            //echo "Inserted record with ID: $id";
        }
    }
?>