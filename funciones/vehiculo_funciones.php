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

    function vehiculo_existe($idv){

        require('conexiones/conexion.php');

        $sqlv="SELECT id_veh FROM vehiculos";

        $resv=mysqli_query($conn,$sqlv);

        if($resv===false){
            echo mysqli_error($conn);
        }

        if($resv){//recorro la base de datos en busca de la id de usuario
            if(mysqli_num_rows($resv)>0){
                while($row = mysqli_fetch_assoc($resv)){
                    if ($row['id_veh']==$idv){

                        return true;
                    }
                }
            }
        }

        return false;
    }

    function id_usuDeVeh($idv){

        require('conexiones/conexion.php');

        $sqlv="SELECT id_usu, id_veh FROM vehiculos;";

        $resv=mysqli_query($conn,$sqlv);

        if($resv===false){
            echo mysqli_error($conn);
        }


        if($resv){//recorro la base de datos en busca de la id de usuario
            if(mysqli_num_rows($resv)>0){
                while($row = mysqli_fetch_assoc($resv)){
                    if ($row['id_veh']==$idv){

                        $datos=$row['id_usu'];
                    }
                }
            }
        }

        return $datos;
    }

    function id_serDeVeh($idv){

        require('conexiones/conexion.php');

        $sqlv="SELECT id_ser, id_veh FROM servicios;";

        $resv=mysqli_query($conn,$sqlv);

        if($resv===false){
            echo mysqli_error($conn);
        }

        $datos="";

        if($resv){//recorro la base de datos en busca de la id de usuario
            if(mysqli_num_rows($resv)>0){
                while($row = mysqli_fetch_assoc($resv)){
                    if ($row['id_veh']==$idv){

                        $datos=$row['id_ser'];
                    }
                }
            }
        }

        if ($datos!="") {
            
            return $datos;
        }
        
    }

    function mostrar_servs($idv){

        require('conexiones/conexion.php');

        $sqlv="SELECT id_ser, id_veh FROM servicios;";

        $resv=mysqli_query($conn,$sqlv);

        if($resv===false){
            echo mysqli_error($conn);
        }

        $datos=[];
        $i=0;
        if($resv){
            if(mysqli_num_rows($resv)>0){
                while($row = mysqli_fetch_assoc($resv)){
                    if ($row['id_veh']==$idv) {
                        
                        $datos[$i]=$row['id_ser'];
                        $i=$i+1;
                    }
                }
            }
        }
        return $datos;
    }

    function nombreUsuVeh($idv,$usuid){

        require('conexiones/conexion.php');

        if ($idv>0) {

            $idu=id_usuDeVeh($idv);
        }
        else {
            
            $idu=$usuid;
        }
        

        $sqlu="SELECT id_usu, nombre, login FROM usuario;";

        $resu=mysqli_query($conn,$sqlu);

        if($resu===false){
            echo mysqli_error($conn);
        }

        $datos=[];

        if($resu){
            if(mysqli_num_rows($resu)>0){
                while($row = mysqli_fetch_assoc($resu)){
                    if ($row['id_usu']==$idu) {
                        
                        $datos[0]=$row['nombre'];
                        $datos[1]=$row['login'];
                    }
                }
            }
        }

        return $datos;
    }
?>