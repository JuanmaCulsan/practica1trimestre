<?php
    require("header.php");
    require('conexion.php');

    $usuario = $_GET['nombre'];
    $contra = $_GET['pass'];
 
    //TIENE QUE TENER EL MISMO VALOR QUE LA COLUMNA DE LA TABLA Y EL VALOR QUE QUEREMOS buscar
    $sql = "SELECT * FROM usuario as us, vehiculos as ve 
            WHERE nombre='$usuario' and pass='$contra' and us.id_usu=ve.id_usu;"; 

    //ESTA FUNCIÓN NOS PIDE LA CONEXION Y LA SENTENCIA SQL
    $results = mysqli_query($conn, $sql);

 
    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $user = mysqli_fetch_all($results, MYSQLI_ASSOC);

        //print_r ($user);
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lista_usu_veh.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <?php if (empty($user)): ?>
                <p>No hay ningún usuario registrado</p>
            <?php else: ?>
                    <h1>Bienvenido/a</h1>
                    <p class="p"><?= $usuario; ?></p>  
                    <!--<p><?= $contra; ?></p>-->
                    <br>
                    <form action="cambiodatos.php">
                        <input type="submit" class="submit" value="EDITAR"></input>   
                    </form>
                    <br>      
                <!--tabla-->
                <table class="table">
                    <tr>
                        <th>matricula</th>
                        <th>marca</th>
                        <th>modelo</th>
                    </tr>
                    <?php foreach($user as $us): ?>
                        <tr>
                            <td><?=$us ['matricula']; ?></td>
                            <td><?=$us ['marca']; ?></td>
                            <td><?=$us ['modelo']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>