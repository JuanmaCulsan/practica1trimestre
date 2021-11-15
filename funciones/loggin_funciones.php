<?php
    function loggearse($login,$pass){
        $headerL="logging.php";//variable para saber donde voy a mandar al usuario
        require "conexiones/conexion.php";
        $sql="SELECT login,pass,admin FROM usuario";//saco de la bbdd todos los usuarios con sus contraseñas, tambien saca si el usuario es administrador
        $res0=mysqli_query($conn,$sql);
        if ($res0) {
            if (mysqli_num_rows($res0)>0) {
                while($fils=mysqli_fetch_assoc($res0)){
                    if (($fils['login']==$login)) { //compruebo si existe en la tabla el usuario enviado con su contraseña correspondiente
                        if (password_verify($pass,$fils['pass'])){ //en caso de que el username y la contraseña concuerden entro

                            

                            $esAdmin=$fils['admin'];//miro si el usuario es administrador

                            if ($esAdmin==0) {//si no es administrador, mando al usuario a la pagina datos_usuario
                            
                            $headerL="datos_usuario.php?loggin=$login";
                            }
                            else if ($esAdmin==1) {//si es administrador, se le mandara a la lista de usuarios
                            
                            $headerL="datos_admin.php"; 

                            }
                            
                            return $headerL;
                        }
                    }
                }
            }
        }
    }
?>