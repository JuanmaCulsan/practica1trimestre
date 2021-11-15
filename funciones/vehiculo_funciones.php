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
    
    function crear_veh($matricula,$marca,$modelo,$idu,$login){

        require('conexiones/conexion.php');

        $sql = "INSERT INTO vehiculos (id_usu, matricula, marca, modelo)
            VALUES ('$idu','$matricula','$marca','$modelo');";

        $results = mysqli_query($conn, $sql);

        if ($results === false) {

            echo mysqli_error($conn);
    
        } else {
    
            echo "Vehiculo creado correctamente";
            header("location: http://localhost:81/cloneSucio/practica1trimestre/datos_usuario.php?loggin=$login");//despues de crear el vehiculo manda al usuario a la lista de servicios
        }
    }

    function datos_veh($idv){

        require('conexiones/conexion.php');

        $sqlv="SELECT * FROM vehiculos ORDER BY id_veh;";

        $resv=mysqli_query($conn,$sqlv);

        if($resv===false){
            echo mysqli_error($conn);
        }


        if($resv){//recorro la base de datos en busca de la id de usuario
            if(mysqli_num_rows($resv)>0){
                while($row = mysqli_fetch_assoc($resv)){
                    if ($row['id_veh']==$idv){

                        $datos=[
                            "matricula"=>$row['matricula'],
                            "marca"=>$row['marca'],
                            "modelo"=>$row['modelo']
                        ];
                    }
                }
            }
        }

        return $datos;
    }
?>