<?php 

    require 'header.php';
    require 'conexiones/conexion.php';
    require 'conexiones/conexion_usu.php';
    require 'conexiones/conexion_vehi.php';
    require 'conexiones/conexion_servi.php';
    require 'funciones/vehiculo_funciones.php';

    if (!isset($_SESSION['username'])) {
        header("Location: logging.php ");
    }

    $id_usu=$_GET['id_usu'];
    $idVehi= $_GET['id_veh'];

    $filasV=mysqli_num_rows($resv);//numero de filas en la tabla vehiculos

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
                <?php foreach ($usu as $us): //foreach para identifiar el nombre del usuario y sacarlo por pantalla?>
                    <?php if ($us['id_usu']==$id_usu): ?>
                    
                        <h1 class="bienvenido" align="center"><?= $us['nombre']; ?></h1>
                        
                        <?php $log=$us['login']?>

                    <?php endif?>   
                <?php endforeach; ?>

                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST"&&$idVehi==$_POST['id_veh']) {//se entra en este if si se esta editando el vehiculo

                        editar_veh($_POST['matri'],$_POST['marc'],$_POST['model'],$idVehi,$id_usu);
                    }
                    else if($_SERVER["REQUEST_METHOD"] == "POST"){//en el caso de crear un vehiculo entra en este else if
                        
                        $sql = "INSERT INTO vehiculos (id_usu, matricula, marca, modelo)
                            VALUES ('". $id_usu ."','". $_POST['matri'] . "','". $_POST['marc'] . "','". $_POST['model'] . "');";

                        $results = mysqli_query($conn, $sql);

                        if ($results === false) {
            
                            echo mysqli_error($conn);
                    
                        } else {
                    
                            echo "Vehiculo creado correctamente";
                            header("location: http://localhost:81/cloneSucio/practica1trimestre/datos_usuario.php?loggin=$log");//despues de crear el vehiculo manda al usuario a la lista de servicios
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

                        
                        <?php if (is_null($idVehi)||($idVehi>$filasV)||$idVehi<=0): //en el caso de que estemos creando un vehiculo?>
                                <tr>
                                    <td><input type="text" name="matri" placeholder="Inserte datos"></td>
                                    <td><input type="text" name="marc" placeholder="Inserte datos"></td>
                                    <td><input type="text" name="model" placeholder="Inserte datos"></td>
                                    <input type="hidden" name="id_veh" value=<?= $filasV+1?>>
                                
                        <?php else: //en caso de que el vehiculo exista, con la posibilidad de editarlo?>
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
                    <input type="reset" class="submit" value="RESET"><!-- boton para eliminar todos los cambios y volver a los valores anteriores -->
                </form> 
                <h3 align="center" class="serVeh">Servicios</h3>

                <table class="table" align="center">
                    
                    <?php 
                    
                    $idS=0;
                    foreach ($servs as $serv) {//guardar la id de servicio, si no eciste se queda el valor inializado anteriormente(0)
                        
                        if ($serv['id_veh']==$idVehi) {
                            
                            $idS=$serv['id_ser'];
                        }
                    }
                    if (($idVehi>0)&&($idS!=0)): //en caso de que existen los servicios?>
                    <tr>
                        <th>Tipo de servicio</th>
                        <th>Fecha</th>
                        <th>Km</th>
                        <th>Editar</th>
                    </tr>
                    <?php else: //en caso de que no existan servicios se le indica al usuario?>
                        <p id="anuncio">Este vehiculo no dispone de servicios actualmente</p>
                    <?php endif?>

                    <?php foreach($servs as $se): //mostrar los datos de todos y poder editar servicios?>
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
                <?php if ($idVehi>0): //crear nuevo servicio?>
                                <form action="servicio.php">
                                    <input type="hidden" name="idSer" value=0>
                                    <input type="hidden" name="id_veh" value=<?= $idVehi?>>
                                    <input type="submit" class="submit" value="NUEVO">
                                </form>
                    <?php else: //en caso de que no puedan crearse servicios se indica al usuario?>
                        <p>No se puden crear servicios hasta que el vehiculo no esté creado</p>
                     <?php endif;?>
            </div>
        </div>
    </body>
    </html>