<?php

    function editar_veh($matricula,$marca,$modelo,$idv,$idu){

                        
        require('conexiones/conexion.php');

        $sql = "UPDATE vehiculos 
            SET matricula='$matricula',marca='$marca',modelo='$modelo' WHERE id_veh='$idv'AND id_usu='$idu';";

        $results = mysqli_query($conn, $sql);

        if ($results === false) {

            echo mysqli_error($conn);

        } else {

            header("location: http://localhost:81/cloneSucio/practica1trimestre/vehiculo.php?id_veh=$idv&id_usu=$idu");
        }
    }
?>