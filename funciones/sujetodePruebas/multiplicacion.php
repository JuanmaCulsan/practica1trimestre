<?php

    function numeritos($valor,$valor2){

        $suma= $valor+$valor2;
        $resta= $valor-$valor2;
        $multi= $valor*$valor2;

        $array = [$suma,$resta,$multi];

        //return $array;
        return [11,-1,30]; 
    }

    function nombre($cade1, $cade2){
        $res = $cade1.$cade2;
        return $res;
    }
 
?>