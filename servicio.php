<?php 
    require 'header.php';
    require 'conexion.php';
    require 'conexion_usu.php';
    require 'conexion_vehi.php';
    require 'conexion_servi.php';

    $idUsu= ;
    $idVehi=$_GET[''];
    $idServ=$_GET[''];
    $nomServ=$_GET[''];
    $fechaServ=$_GET[''];
    $kmServ=$_GET[''];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Servicio</title>
</head>
<body>
    
    <main>

    <table border="1">

        <?php foreach ($usu as $us): ?>
            <?php if ($us['id_usu']==2): ?>
                
                <hr><h1><?= $us['nombre']; ?></h1></hr>
                
            <?php $idUsu=$us['id_usu']?>
            <?php endif?>   
        <?php endforeach; ?>

        <tr><td><h3>Vehiculo</h3></td></tr>
        <?php foreach ($vehi as $car): ?>
            <?php if ($car['id_veh']==2): ?>
            <tr>
                <td><label><?= $car['matricula']; ?></label></td>
                <td><label><?= $car['marca']; ?></label></td>
                <td><label><?= $car['modelo']; ?></label></td>
                
            </tr>
            <?php $idVehi=$car['id_veh']?>
            <?php endif?>   
        <?php endforeach; ?>
    </table>

    <form>

        <h3>Servicio</h3>

        <?php if (empty($servs)): ?>

            <label>Tipo de servicio</label><label>Fecha</label><br>
            <input type="text" name="tipoServicio">
            <input type="text" name="fecha"> <br>
        
            <label>Descripcion</label><br>
            <input type="text" name="descripcion">
            <input type="submit" value="GUARDAR">
        <?php else: ?>

            <?php foreach ($servs as $se): ?>
                <?php if ($se['id_veh']==$idVehi): ?>

                    <label>Tipo de servicio</label><label>Fecha</label><br>
                    <input type="text" name="tipoServicio" placeholder=<?= $se['descrip']; ?>>
                    <input type="text" name="fecha" placeholder=<?= $se['fecha']; ?>> <br>
                
                    <label>Km</label><br>  
                    <input type="text" name="km" placeholder=<?= $se['km']; ?>>
                    <input type="submit"  value="GUARDAR">

                <?php endif?>
            <?php endforeach; ?>
        <?php endif?>
    
    </form>
    </main>

</body>
</html>