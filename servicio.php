<?php 

    require 'header.php';
    require 'conexiones/conexion.php';
    require 'conexiones/conexion_usu.php';
    require 'conexiones/conexion_vehi.php';
    require 'conexiones/conexion_servi.php';

    $idServ=$_GET['idSer'];

    $filasServ=mysqli_num_rows($res);

    $idVehi= $_GET['id_veh'];

    foreach ($vehi as $v) {
        
        if ($v['id_veh']==$idVehi) {
            
            $id_usu=$v['id_usu'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/lista_usu_veh.css">
    <title>Servicio</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <?php foreach ($usu as $us): ?>
                <?php if ($us['id_usu']==$id_usu): ?>
                    <h1 class="bienvenido"><?= $us['nombre']; ?></h1>
                <?php endif?>   
            <?php endforeach; ?>
            <h3 class="serVeh">Vehiculo</h3>
                <table  id="tablaServicio">
                
                <?php foreach ($vehi as $car): ?>
                    <?php if ($car['id_veh']==$idVehi): ?>
                    <tr>
                        <td><label><?= $car['matricula']; ?></label></td>
                        <td><label><?= $car['marca']; ?></label></td>
                        <td><label><?= $car['modelo']; ?></label></td>
                        
                    </tr>
                    <?php endif?>   
                <?php endforeach; ?>
            </table>
                        
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"&&$idServ==$_POST['idSer']) {

                    
                    $sql = "UPDATE servicios 
                        SET descrip='". $_POST['tipoServicio'] . "',fecha='". $_POST['fecha'] . "',km='". $_POST['km'] . "' WHERE id_ser='".$idServ."'AND id_veh='".$idVehi."';";

                    $results = mysqli_query($conn, $sql);

                    if ($results === false) {
        
                        echo mysqli_error($conn);
                
                    } else {
                
                        $id = mysqli_insert_id($conn);
                        echo "Servicio editado correctamente";
                    }
                }
                else if($_SERVER["REQUEST_METHOD"] == "POST"){
                    
                    $sql = "INSERT INTO servicios (id_ser, id_veh, descrip, fecha, km)
                        VALUES ('". $_POST['idSer'] . "','". $idVehi ."','". $_POST['tipoServicio'] . "','". $_POST['fecha'] . "','". $_POST['km'] . "');";

                    $results = mysqli_query($conn, $sql);

                    if ($results === false) {
        
                        echo mysqli_error($conn);
                
                    } else {
                
                        $id = mysqli_insert_id($conn);
                        echo "Servicio creado correctamente";
                        header("location: http://localhost:81/cloneSucio/practica1trimestre/datos_usuario.php?id_usu=$id_usu");
                    }
                }
            ?>

            <h3 class="serVeh">Servicio</h3>
                
            <?php if (is_null($idServ)||($idServ>$filasServ)||$idServ<=0): ?>

                
                <form method="POST">

                    <table>
                        <tr>
                            <th>Tipo de servicio</th>
                            <th>Fecha</th>
                            <th>km</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="tipoServicio" placeholder="Inserte datos"></td>
                            <td><input type="date" name="fecha"></td>
                            <td><input type="text" name="km" placeholder="Inserte datos"></td>
                        </tr>
                    </table>
                    <input type="hidden" name="idSer" value=<?= ($filasServ)+1?>>
                    <input type="submit" value="GUARDAR">
                </form>
                
            <?php else: ?>

                <form method="POST">

                    <?php foreach ($servs as $se): ?>
                        <?php if ($se['id_ser']==$idServ): ?>
                            <table>
                                <tr>
                                    <th>Tipo de servicio</th>
                                    <th>Fecha</td>
                                    <th>Km</th>
                                </tr>
                                
                                <tr>
                                    <td><input type="text" name="tipoServicio" value=<?= $se['descrip']; ?> placeholder="Inserte datos"></td>
                                    <td><input type="date" name="fecha" value=<?= $se['fecha']; ?>></td>
                                    <td><input type="text" name="km" value=<?= $se['km']; ?> placeholder="Inserte datos"></td>
                                </tr>
                            </table>

                            <input type="hidden" name="idSer" value=<?= $idServ?>>
                            <input type="submit" class="submit"  value="GUARDAR">
                            <input type="reset" class="submit" value="Reiniciar">

                        <?php endif?>
                    <?php endforeach; ?>
                </form>
            <?php endif?>
        </div>
    </div>
</body>
</html>