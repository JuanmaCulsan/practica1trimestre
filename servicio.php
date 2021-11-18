<?php 

    require 'header.php';
    require 'conexiones/conexion.php';
    require 'conexiones/conexion_usu.php';
    require 'funciones/vehiculo_funciones.php';
    require 'funciones/servicio_funciones.php';

    if (!isset($_SESSION['username'])) {
        header("Location: logging.php ");
    }

    $idServ=$_GET['idSer'];

    $idVehi= $_GET['id_veh'];
   
    if (vehiculo_existe($idVehi)) {
        
        $id_usu=$idVehi;
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
            
            <h1 class="bienvenido"><?= nombreUsuVeh($idVehi,0)[0]; ?></h1>
            <h3 class="serVeh">Vehiculo</h3>
                <table  id="tablaServicio">
                
                <?php $datosV=datos_veh($idVehi)?>
                <tr>
                    <td><label><?= $datosV['matricula']; ?></label></td>
                    <td><label><?= $datosV['marca']; ?></label></td>
                    <td><label><?= $datosV['modelo']; ?></label></td>
                    
                </tr>
            </table>
                        
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    if (($_POST['tipoServicio'])!=""&&($_POST['fecha'])!=""&&($_POST['km'])!="") {
                            
                        if (servicio_existe($_POST['idSer'])) {//en este caso entra si se esta editando servicios

                            editar_ser($_POST['tipoServicio'],$_POST['fecha'],$_POST['km'],$idServ,$idVehi);
                        }
                        else{//en este caso entra si se esta creando servicios y luego manda al usuario a la lista de vehiuculos
                            crear_ser($_POST['tipoServicio'],$_POST['fecha'],$_POST['km'],$_POST['idSer'],$idVehi,$id_usu);
                        }
                    }
                    else{
                        echo "Rellena los campos correctamente";
                    }
                }
            ?>

            <h3 class="serVeh">Servicio</h3>
                
            <?php if (!servicio_existe($idServ)): //mostrar datos de nuevo servicio?>

                
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
                    <input type="submit" value="GUARDAR">
                </form>
                
            <?php else: //datos de servicio ya creado y editable?>

                <form method="POST">

                    <?php $datosS=datos_ser($idServ)?>
                    <table>
                        <tr>
                            <th>Tipo de servicio</th>
                            <th>Fecha</td>
                            <th>Km</th>
                        </tr>
                        
                        <tr>
                            <td><input type="text" name="tipoServicio" value=<?= $datosS['descrip']; ?> placeholder="Inserte datos"></td>
                            <td><input type="date" name="fecha" value=<?= $datosS['fecha']; ?>></td>
                            <td><input type="text" name="km" value=<?= $datosS['km']; ?> placeholder="Inserte datos"></td>
                        </tr>
                    </table>

                    <input type="hidden" name="idSer" value=<?= $datosS['id_ser']?>>
                    <input type="submit" class="submit"  value="GUARDAR">   
                    <input type="reset" class="submit" value="Reiniciar">
                </form>
            <?php endif?>
        </div>
    </div>
</body>
</html>