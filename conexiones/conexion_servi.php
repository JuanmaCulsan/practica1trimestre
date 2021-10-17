<?php

    $sqlser="SELECT * FROM servicios ORDER BY id_ser;";

    $res=mysqli_query($conn,$sqlser);

    if($res===false){
        echo mysqli_error($conn);
    }
        else{
        $servs=mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

?>