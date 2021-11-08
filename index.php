<?php
    require("header.php");
    require("conexiones/conexion.php");
?>
<?php
   

   if(isset($_POST["register"])){

    if (strlen($_POST["name"]) >= 1 &&
    strlen($_POST["login"]) >= 1 &&
    strlen($_POST["pass"]) >= 1 ){

        $name=trim($_POST["name"]);
        $login=trim ($_POST["login"]);
        $pass=trim ($_POST["pass"]);
        $repetido=false;
        
        $sql="SELECT login, id_usu FROM usuario";
        $sqlconfirm=mysqli_query($conn,$sql);
        
        
        if($sqlconfirm){
            if(mysqli_num_rows($sqlconfirm)>0){
                while($row = mysqli_fetch_assoc($sqlconfirm)){
                    if ($row['login']==$login) {
                        $repetido=true;
                        $id_user=$row['id_usu'];
                    }
                }
            }

            if($repetido) {
                ?>
                    <h3 class="bad">El nombre del login ya existe.</h3>
                <?php
            }
            else{

                $consulta="INSERT INTO usuario( nombre, login, pass) VALUES ('".$name."','".$login."','".password_hash($pass,PASSWORD_DEFAULT)."')";
                $resultado=mysqli_query($conn,$consulta);

                if($resultado){
                    ?>
                        <h3 class="ok">Te has registardo exitosamente.</h3>    
                    <?php
                    header("location: http://localhost:81/cloneSucio/practica1trimestre/datos_usuario.php?id_usu=$id_user");
                    }else{
                        ?>
                            <h3 class="bad">Has tenido un error.</h3>
                        <?php
            
                    }
            }
        }else{
            ?>
                <h3 class="bad">Has tenido un error.</h3>
            <?php
        }
    }else{
        ?>
            <h3 class="bad">Por favor complete los campos correctamente.</h3>
            <?php
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registrar usuario</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="estilos/ccs_nuevo_usuario.css">


</head>
<body>
    <form method="post">

        <h1>Registrate</h1>
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="login" placeholder="Nombre de login">
        <input type="text" name="pass" placeholder="Contraseña">
        <input type="submit" name="register">
    </form>
</body>




</html>