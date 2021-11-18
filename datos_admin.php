<?php
    require("header.php");
    require("conexiones/conexion.php");

    if (!isset($_SESSION['username'])) {
        header("Location: logging.php ");
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilos/lista_usu_veh.css">
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1>Tabla de usuarios</h1>  
                <table class="tabla" >
                    <br>
                    <tr>
                    <td><b>id</b></td>
                    <td><b>Nombre</b></td>
                    <td><b>Login</b></td>
                    <td></td>
                    </tr>

                    <?php
                        $sql= "SELECT * FROM usuario";

                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)>0):
                        while($mostar = mysqli_fetch_assoc($res)):    
                    ?>

                    <tr>
                    <td><?php echo $mostar['id_usu']?></td>
                    <td><?php echo $mostar['nombre']?></td>
                    <td><?php echo $mostar['login']?></td>
                    <form action="datos_usuario.php" method="GET">
                        <input type="hidden" value=<?=$mostar['login']?> name='loggin'>
                        <td><input type="submit" value="Ir a Usuario"></td>
                    </form>
                        
                    </tr>
                    <?php endwhile; endif;?>
                    </br>
                </table>
            </div>
        </div>
    </body>
</html>