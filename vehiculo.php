<?php 

    require 'header.php';
    require 'conexiones/conexion.php';
    require 'conexiones/conexion_usu.php';
    require 'conexiones/conexion_vehi.php';
    require 'conexiones/conexion_servi.php';

    $idUsu=2;//$_GET['idUsu'];
    $idVehi= 2;//$_GET['idVe'];

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
        
        <main>


            <?php foreach ($usu as $us):?>
                <?php if ($us['id_usu']==$idUsu): ?>
                
                    <hr><h1><?= $us['nombre']; ?></h1></hr>
                
                <?php endif?>   
            <?php endforeach; ?>
            
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
                            <td><input type="text" name="tipoServicio" placeholder="Inserte datos"></td>
                            <td><input type="text" name="tipoServicio" placeholder="Inserte datos"></td>
                            <td><input type="text" name="tipoServicio" placeholder="Inserte datos"></td>
                        </tr>
                        <tr>
                            <td>
                            <input type="reset" value="Reset">
                            </td>
                        </tr>
                    </form>
                <?php else: ?>

                    <?php foreach ($vehi as $car): ?>
                        <?php if ($car['id_veh']==$idVehi): ?>
                            <form method="POST">    

                                <tr>
                                    <td><input type="text" name="tipoServicio" value=<?= $car['matricula']; ?> placeholder="Inserte datos"></td>
                                    <td><input type="text" name="tipoServicio" value=<?= $car['marca']; ?> placeholder="Inserte datos"></td>
                                    <td><input type="text" name="tipoServicio" value=<?= $car['modelo']; ?> placeholder="Inserte datos"></td>
                                </tr>
                                <tr>
                                    <td>
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
                <tr>
                    <th>Tipo de servicio</th>
                    <th>Fecha</th>
                    <th>Km</th>
                </tr>
                <?php foreach($servs as $se): ?>
                    <?php if($idVehi==$se['id_veh']): ?>
                    <tr>
                        <td><?=$se ['descrip']; ?></td>
                        <td><?=$se ['fecha']; ?></td>
                        <td><?=$se ['km']; ?></td>
                        <td>
                            <form action="servicio.php">
                                <input type="hidden" name="idSer" value=<?= $se['id_ser']?>>  
                                <input type="hidden" name="idVe" value=<?= $idVehi?>>   
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
                                <input type="hidden" name="idVe" value=<?= $idVehi?>>
                                <input type="submit" value="NUEVO">
                            </form>
                        <?php else:?>
                                <p>No se puden crear servicios hasta que el vehiculo no esté creado</p>
                        <?php endif;?>
                    </td>
                </tr>
            </table>

        </main>

    </body>
    </html>