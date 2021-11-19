<?php 

    require 'header.php';
    require 'conexiones/conexion.php';
    require 'funciones/vehiculo_funciones.php';
    require 'funciones/servicio_funciones.php';

    if (!isset($_SESSION['username'])) {
        header("Location: logging.php ");
    }

    $id_usu=$_GET['id_usu'];
    $idVehi= $_GET['id_veh'];

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

                <h1 class="bienvenido" align="center"><?= nombreUsuVeh($idVehi,$id_usu)[0] ?></h1>
                
                <?php $log=nombreUsuVeh($idVehi,$id_usu)[1]?>

                <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                        if (($_POST['matri'])!=""&&($_POST['marc'])!=""&&($_POST['model'])!="") {
                            
                            if (vehiculo_existe($_POST['id_veh'])) {//se entra en este if si se esta editando el vehiculo
                                editar_veh($_POST['matri'],$_POST['marc'],$_POST['model'],$idVehi,$id_usu);
                            }
                            else{//en el caso de crear un vehiculo entra en este else
                                crear_veh($_POST['matri'],$_POST['marc'],$_POST['model'],$id_usu,$log);
                            }
                        }
                        else{
                            echo "Rellena los campos correctamente";
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

                        
                        <?php if (!vehiculo_existe($idVehi)): //en el caso de que estemos creando un vehiculo?>  
                                <tr>
                                    <td><input type="text" name="matri" placeholder="Inserte datos"></td>
                                    <td><input type="text" name="marc" placeholder="Inserte datos"></td>
                                    <td><input type="text" name="model" placeholder="Inserte datos"></td>
                                
                        <?php else: //en caso de que el vehiculo exista, con la posibilidad de editarlo?>
                            <tr>
                                <?php $datosV =datos_veh($idVehi)?>

                                <td><input type="text" name="matri" value=<?= $datosV['matricula']; ?> placeholder="Inserte datos"></td>
                                <td><input type="text" name="marc" value=<?= $datosV['marca']; ?> placeholder="Inserte datos"></td>
                                <td><input type="text" name="model" value=<?= $datosV['modelo']; ?> placeholder="Inserte datos"></td>
                            </tr>
                            <input type="hidden" name="id_veh" value=<?= $idVehi?>>
                        <?php endif;?>
                    </table> 
                    
                    <input type="submit" class="submit" value="GUARDAR">
                    <input type="reset" class="submit" value="RESET"><!-- boton para eliminar todos los cambios y volver a los valores anteriores -->
                </form> 
                <h3 align="center" class="serVeh">Servicios</h3>

                <table class="table" align="center">
                    
                    <?php 
                    
                    $idS=id_serDeVeh($idVehi);
                    
                    if (servicio_existe($idS)): //en caso de que existen los servicios?>
                    <tr>
                        <th>Tipo de servicio</th>
                        <th>Fecha</th>
                        <th>Km</th>
                        <th>Editar</th>
                    </tr>
                    <?php else: //en caso de que no existan servicios se le indica al usuario?>
                        <p id="anuncio">Este vehiculo no dispone de servicios actualmente</p>
                    <?php endif?>

                    <?php 

                        $idservs=mostrar_servs($idVehi);
                        
                        for ($i=0; $i < sizeof($idservs); $i++):
                            $datosS=datos_ser($idservs[$i]);
                    ?>
                    <tr>
                        <td><?=$datosS ['descrip']; ?></td>
                        <td><?=$datosS ['fecha']; ?></td>
                        <td><?=$datosS ['km']; ?></td>
                        <td>
                            <form action="servicio.php">
                                <input type="hidden" name="idSer" value=<?= $datosS['id_ser']?>>  
                                <input type="hidden" name="id_veh" value=<?= $idVehi?>>   
                                <input type="submit" class="boton_veh" value="EDITAR">
                            </form>
                        </td>
                    </tr>
                    <?php endfor;?>
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