<?php
    function nuevo_usuario($name,$login,$pass){

        require("conexiones/conexion.php");
        $consulta="INSERT INTO usuario( nombre, login, pass) VALUES ('$name','$login','".password_hash($pass,PASSWORD_DEFAULT)."')";//E: encriptamos la contraseña para poder guardarla en bbdd
        $resultado=mysqli_query($conn,$consulta);

        if($resultado){
            ?>
                <h3 class="ok">Te has registardo exitosamente.</h3>    
            <?php //si te registras de forma exitosa, vas a la pagina datos_usuario de forma automatica, mandando los datos necesarios

            
        }else{
                ?>
                    <h3 class="bad">Has tenido un error.</h3>
                <?php
    
        }
    }
?>