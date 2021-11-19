<?php

    function editar_ser($desc,$fecha,$km,$ids,$idv){

                            
        require('conexiones/conexion.php');

        $sql = "UPDATE servicios 
                SET descrip='$desc',fecha='$fecha',km='$km' WHERE id_ser='".$ids."'AND id_veh='".$idv."';";

        $results = mysqli_query($conn, $sql);

        if ($results === false) {

            echo mysqli_error($conn);

        } else {

            header("location: http://localhost:81/cloneSucio/practica1trimestre/servicio.php?idSer=$ids&id_veh=$idv");
        }
    }

    function crear_ser($desc,$fecha,$km,$ids,$idv,$idu){

        require('conexiones/conexion.php');

        $sql = "INSERT INTO servicios (id_ser, id_veh, descrip, fecha, km)
                VALUES ('$ids','$idv','$desc','$fecha','$km');";

        $results = mysqli_query($conn, $sql);

        if ($results === false) {

            echo mysqli_error($conn);
    
        } else {
    
            header("location: http://localhost:81/cloneSucio/practica1trimestre/vehiculo.php?id_veh=$idv&id_usu=$idu");
        }
    }

    function servicio_existe($ids){

        require('conexiones/conexion.php');

        $sqls="SELECT id_ser FROM servicios";

        $ress=mysqli_query($conn,$sqls);

        if($ress===false){
            echo mysqli_error($conn);
        }

        if ($ids>0) {

            if($ress){//recorro la base de datos en busca de la id de usuario
                if(mysqli_num_rows($ress)>0){
                    while($row = mysqli_fetch_assoc($ress)){
                        if ($row['id_ser']==$ids){
    
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    function datos_ser($ids){

        require('conexiones/conexion.php');

        $sqls="SELECT * FROM servicios;";

        $ress=mysqli_query($conn,$sqls);

        if($ress===false){
            echo mysqli_error($conn);
        }

        $datos=0;
        if($ress){
            if(mysqli_num_rows($ress)>0){
                while($row = mysqli_fetch_assoc($ress)){
                    if ($row['id_ser']==$ids){

                        $datos=[
                            "descrip"=>$row['descrip'],
                            "fecha"=>$row['fecha'],
                            "km"=>$row['km'],
                            "id_ser"=>$row['id_ser']
                        ];
                    }
                }
            }
        }

        return $datos;
    }
?>