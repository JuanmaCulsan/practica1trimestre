<?php 

    require 'header.php';
    require 'conexiones/conexion.php';
    require 'conexiones/conexion_usu.php';
    require 'conexiones/conexion_vehi.php';
    require 'conexiones/conexion_servi.php';

    $id_usu=$_GET['id_usu'];
    $idVehi= $_GET['id_veh'];

    $filasV=mysqli_num_rows($resv);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <?php foreach ($usu as $us):?>
            <?php if ($us['id_usu']==$id_usu): ?>
            
                <h1><?= $us['nombre']; ?></h1>
            
            <?php endif?>   
        <?php endforeach; ?>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"&&$idVehi==$_POST['id_veh']) {

                
                $sql = "UPDATE vehiculos 
                    SET matricula='". $_POST['matri'] . "',marca='". $_POST['marc'] . "',modelo='". $_POST['model'] . "' WHERE id_veh='".$idVehi."'AND id_usu='".$id_usu."';";

                $results = mysqli_query($conn, $sql);

                if ($results === false) {
    
                    echo mysqli_error($conn);
            
                } else {
            
                    $id = mysqli_insert_id($conn);
                    echo "Vehiculo editado correctamente";
                }
            }
            else if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                $sql = "INSERT INTO vehiculos (id_usu, matricula, marca, modelo)
                    VALUES ('". $id_usu ."','". $_POST['matri'] . "','". $_POST['marc'] . "','". $_POST['model'] . "');";

                $results = mysqli_query($conn, $sql);

                if ($results === false) {
    
                    echo mysqli_error($conn);
            
                } else {
            
                    $id = mysqli_insert_id($conn);
                    echo "Vehiculo creado correctamente";
                    header("location: http://localhost:81/pruebaclone/practica1trimestre/datos_usuario.php?id_usu=$id_usu");
                }
            }
        ?>
        
        <h3>Vehiculo</h3>
        <table>
            <tr>
                <th>matricula</th>
                <th>marca</th>
                <th>modelo</th>
            </tr>

            
            <?php if (is_null($idVehi)||($idVehi>$filasV)||$idVehi<=0): ?>
                <form method="POST">
                    <tr>
                        <td><input type="text" name="matri" placeholder="Inserte datos"></td>
                        <td><input type="text" name="marc" placeholder="Inserte datos"></td>
                        <td><input type="text" name="model" placeholder="Inserte datos"></td>
                    </tr>
                    <tr>
                        <td>
                        <input type="hidden" name="id_veh" value=<?= $filasV+1?>>
                        <input type="reset" value="Reset">
                        <input type="submit" value="GUARDAR">
                        </td>
                    </tr>
                </form>
            <?php else: ?>

                <?php foreach ($vehi as $car): ?>
                    <?php if ($car['id_veh']==$idVehi): ?>
                        <form method="POST">    

                            <tr>
                                <td><input type="text" name="matri" value=<?= $car['matricula']; ?> placeholder="Inserte datos"></td>
                                <td><input type="text" name="marc" value=<?= $car['marca']; ?> placeholder="Inserte datos"></td>
                                <td><input type="text" name="model" value=<?= $car['modelo']; ?> placeholder="Inserte datos"></td>
                            </tr>
                            <tr>
                                <td>
                                <input type="hidden" name="id_veh" value=<?= $idVehi?>>
                                <input type="submit" value="GUARDAR">
                                <input type="reset" value="Reset">
                                </td>
                            </tr>
                        </form>  
                    <?php endif;?>
                <?php endforeach; ?>
            <?php endif;?>
        </table>
    
        <h3>Servicios</h3>

        <table class="table">
            
            <?php 
            
            $idS=0;
            foreach ($servs as $serv) {
                
                if ($serv['id_veh']==$idVehi) {
                    
                    $idS=$serv['id_ser'];
                }
            }
            if (($idVehi>0)&&($idS!=0)):?>
            <tr>
                <th>Tipo de servicio</th>
                <th>Fecha</th>
                <th>Km</th>
            </tr>
            <?php else:?>
                <p>Este vehiculo no dispone de servicios actualmente</p>
            <?php endif?>

            <?php foreach($servs as $se): ?>
                <?php if($idVehi==$se['id_veh']): ?>
                <tr>
                    <td><?=$se ['descrip']; ?></td>
                    <td><?=$se ['fecha']; ?></td>
                    <td><?=$se ['km']; ?></td>
                    <td>
                        <form action="servicio.php">
                            <input type="hidden" name="idSer" value=<?= $se['id_ser']?>>  
                            <input type="hidden" name="id_veh" value=<?= $idVehi?>>   
                            <input type="submit" value="EDITAR">
                        </form>
                    </td>
                </tr>
                <?php endif;?>
            <?php endforeach; ?>
            
            <tr>
                <td>
                    <?php if ($idVehi>0):?>
                        <form action="servicio.php">
                            <input type="hidden" name="idSer" value=0>
                            <input type="hidden" name="id_veh" value=<?= $idVehi?>>
                            <input type="submit" value="NUEVO">
                        </form>
                    <?php else:?>
                            <p>No se puden crear servicios hasta que el vehiculo no esté creado</p>
                    <?php endif;?>
                </td>
            </tr>
        </table>

    </body>
    </html>