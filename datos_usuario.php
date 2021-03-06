<?php
    require("header.php");
    require('conexiones/conexion.php');

    $idVe=0;//inicializo las id de vehiculo y usuario en caso de no recibirlas
    $id=0;
    if ((isset($_GET['loggin'])||(isset($_POST['login'])))) {//en este if compruebo si me pasan el username(login) y saco la id del usuario
        
        $loggin=$_GET['loggin'];
        
        $sql="SELECT id_usu FROM usuario WHERE login='$loggin'";
        
        $queryIdUsu = mysqli_query($conn,$sql);

        if($queryIdUsu){//recorro la base de datos en busca de la id de usuario
            if(mysqli_num_rows($queryIdUsu)>0){
                while($row = mysqli_fetch_assoc($queryIdUsu)){
                    $id = $row['id_usu'];
                }
            }
        }
    } 
    
    if (!isset($_SESSION['username'])) {
        header("Location: logging.php ");
    }

    //TIENE QUE TENER EL MISMO VALOR QUE LA COLUMNA DE LA TABLA Y EL VALOR QUE QUEREMOS buscar
    //usar el id_usuario 
    $sql = "SELECT * FROM usuario as us, vehiculos as ve 
            WHERE us.id_usu='$id' and us.id_usu=ve.id_usu;"; 

    //ESTA FUNCIÓN NOS PIDE LA CONEXION Y LA SENTENCIA SQL
    $results = mysqli_query($conn, $sql);

 
    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $user = mysqli_fetch_all($results, MYSQLI_ASSOC);

        //print_r ($user);
    } 
    
    $sql2 = "SELECT * FROM usuario as us 
            WHERE id_usu='$id'"; 

    //ESTA FUNCIÓN NOS PIDE LA CONEXION Y LA SENTENCIA SQL
    $results2 = mysqli_query($conn, $sql2);

 
    if ($results2 === false) {
            echo mysqli_error($conn);
    } else {
        $user2 = mysqli_fetch_all($results2, MYSQLI_ASSOC);

        //print_r ($user);
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
            <?php if (empty($user2)): ?>
                <p>No hay ningún usuario registrado</p>
            <?php else: ?>
                    <h1 class="bienvenido">Bienvenido/a</h1>
                    <?php foreach($user2 as $us): ?>
                        <p id="usuname">Nombre: <?=$us ['nombre']; ?></p>  
                        <!--<p class="p"><?=$us ['pass']; ?></p>-->
                        <p id="usulogin">Login: <?=$us ['login']; ?></p>
                    <?php endforeach; ?>
                    <form action="cambiodatos.php">
                        <input type="hidden" value=<?=$id?> name='id_usu'>
                        <input type="submit" class="submit" value="EDITAR USUARIO"></input>   
                    </form>   
                <!--tabla-->
                <table >
                    <tr>
                        
                        <?php foreach ($user as $dato) {
                            if ($dato['id_usu']==$id) {
                                $idVe=$dato['id_veh'];
                            }
                        }
                        ?>
                        <?php if ($idVe>0):?>
                            <th>MATRICULA</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>EDITAR</th>
                        <?php endif?>
                    </tr>
                    <?php foreach($user as $us): ?>
                        <tr>
                            <td><?=$us ['matricula']; ?></td>
                            <td><?=$us ['marca']; ?></td>
                            <td><?=$us ['modelo']; ?></td>
                            <form action="vehiculo.php" method="GET">
                                <input type="hidden" value=<?=$us ['id_veh']?> name='id_veh'>
                                <input type="hidden" value=<?=$id?> name='id_usu'>
                                <td><input type="submit" value="editar vehiculo" class="boton_veh"></td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br>
                <form action="vehiculo.php" method="GET">
                    <input type="hidden" value=<?=$id?> name='id_usu'>
                    <input type="hidden" value=0 name='id_veh'>
                    <td><input type="submit" value="+ AÑADIR VEHICULO" class="submit"></td>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>