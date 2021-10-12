<?php
    require("header.php");
    require('conexion.php');

    $usuario = $_GET['nombre'];
    $contra = $_GET['pass'];
 
    //TIENE QUE TENER EL MISMO VALOR QUE LA COLUMNA DE LA TABLA Y EL VALOR QUE QUEREMOS buscar
    $sql = "SELECT * FROM usuario as us, vehiculos as ve WHERE nombre='$usuario' and pass='$contra' and us.id_usu=ve.id_usu;"; 

    //ESTA FUNCIÓN NOS PIDE LA CONEXION Y LA SENTENCIA SQL
    $results = mysqli_query($conn, $sql);

 
    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $user = mysqli_fetch_all($results, MYSQLI_ASSOC);

        //print_r ($user);
    }    
?>


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
    <header>
        <h1>USUARIOS</h1>
    </header>
 
    <main>
        <?php if (empty($user)): ?>
            <p>No hay ningún usuario registrado</p>
        <?php else: ?>
            <ul>
                <!--poner aqui el formulario-->
                <?php foreach($user as $us) ?>
                <form>
                    <label for="">Nombre</label><br>
                    <input type="text" value=<?= $us['nombre']; ?>><br>
                    
                    <label for="">login</label><br>
                    <input type="text" value="<?=$us ['login']; ?>"><br>
                    
                    <label for="">pass</label><br>
                    <input type="text" value="<?=$us ['pass']; ?>"><br>
                    
                    <label for="">matricula</label><br>
                    <input type="text" value="<?=$us ['matricula'];?>"><br>
                    
                    <label for="">marca</label><br>
                    <input type="text" value="<?=$us ['marca']; ?>"><br>
                    
                    <label for="">modelo</label><br>
                    <input type="text" value="<?=$us ['modelo']; ?>"><br>

                    <br>
                    <input type="submit" value="cambiar">
                </form>
                <?php
                    echo "<table border='1'>";
                    echo "<tr><th>matricula</th><th>marca</th><th>modelo</th></tr>";
                    while ($row = mysql_fetch_array($results)){
                        echo "<tr>";
                        echo "<td>".$row['matricula']."</td>";
                        echo "<td>".$row['marca']."</td>";
                        echo "<td>".$row['modelo']."</td>";
                        echo "</tr>";
                    }                  
                    echo "</table>";
                ?>
                <?php endif; ?>
            </ul>
    </main>
</body>
</html>