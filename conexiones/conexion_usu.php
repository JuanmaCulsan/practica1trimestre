<?php
    //conexion para tabla de usuarios
    $sqlusu="SELECT * FROM usuario ORDER BY id_usu;";

    $resu=mysqli_query($conn,$sqlusu);

    if($resu===false){
        echo mysqli_error($conn);
    }
    else{
        $usu=mysqli_fetch_all($resu, MYSQLI_ASSOC);
    }

?>