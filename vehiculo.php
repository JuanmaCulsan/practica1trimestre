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
        <link rel="stylesheet" href="estilos/lista_usu_veh.css">
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <?php foreach ($usu as $us):?>
                    <?php if ($us['id_usu']==$id_usu): ?>
                    
                        <h1 class="bienvenido" align="center"><?= $us['nombre']; ?></h1>
                    
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
                
                <h3 class="serVeh" align="center">Vehiculo</h3>
                <form method="POST">
                    <table class="table" align="center">
                        <tr>
                            <th>matricula</th>
                            <th>marca</th>
                            <th>modelo</th>
                        </tr>

                        
                        <?php if (is_null($idVehi)||($idVehi>$filasV)||$idVehi<=0): ?>
                                <tr>
                                    <td><input type="text" name="matri" placeholder="Inserte datos"></td>
                                    <td><input type="text" name="marc" placeholder="Inserte datos"></td>
                                    <td><input type="text" name="model" placeholder="Inserte datos"></td>
                                    <input type="hidden" name="id_veh" value=<?= $filasV+1?>>
                                
                        <?php else: ?>
                            <?php foreach ($vehi as $car): ?>
                                <?php if ($car['id_veh']==$idVehi): ?>
                                        
                                        <tr>
                                            <td><input type="text" name="matri" value=<?= $car['matricula']; ?> placeholder="Inserte datos"></td>
                                            <td><input type="text" name="marc" value=<?= $car['marca']; ?> placeholder="Inserte datos"></td>
                                            <td><input type="text" name="model" value=<?= $car['modelo']; ?> placeholder="Inserte datos"></td>
                                        </tr>
                                        <input type="hidden" name="id_veh" value=<?= $idVehi?>>
                                <?php endif;?>
                            <?php endforeach; ?>
                        <?php endif;?>
                    </table> 
                    
                    <input type="submit" class="submit" value="GUARDAR">
                    <input type="reset" class="submit" value="RESET">
                </form> 
                <h3 align="center" class="serVeh">Servicios</h3>

                <table class="table" align="center">
                    
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
                        <th>Editar</th>
                    </tr>
                    <?php else:?>
                        <p id="anuncio">Este vehiculo no dispone de servicios actualmente</p>
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
                                    <input type="submit" class="boton_veh" value="EDITAR">
                                </form>
                            </td>
                        </tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                </table>
                <?php if ($idVehi>0):?>
                                <form action="servicio.php">
                                    <input type="hidden" name="idSer" value=0>
                                    <input type="hidden" name="id_veh" value=<?= $idVehi?>>
                                    <input type="submit" class="submit" value="NUEVO">
                                </form>
                    <?php else:?>
                        <p>No se puden crear servicios hasta que el vehiculo no esté creado</p>
                     <?php endif;?>
            </div>
        </div>
    </body>
    </html>