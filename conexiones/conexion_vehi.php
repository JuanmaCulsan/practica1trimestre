<?php
    //conexion para tabla de vehiculos
    $sqlv="SELECT * FROM vehiculos ORDER BY id_veh;";

    $resv=mysqli_query($conn,$sqlv);

    if($resv===false){
        echo mysqli_error($conn);
    }
    else{
        $vehi=mysqli_fetch_all($resv, MYSQLI_ASSOC);
    }

?>