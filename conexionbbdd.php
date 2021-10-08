<?php
    require("header.php");
    require('conexion.php');

    $usuario = $_GET['nombre'];
    $pass = $_GET['pass'];
 
    //TIENE QUE TENER EL MISMO VALOR QUE LA COLUMNA DE LA TABLA Y EL VALOR QUE QUEREMOS buscar
    $sql = "SELECT * FROM usuario where nombre='$usuario' AND pass='$pass'";
 
    $results = mysqli_query($conn, $sql);
    
 
    if ($results === false) {
        echo mysqli_error($conn);
    } else {
        $user = mysqli_fetch_all($results, MYSQLI_ASSOC);

        print_r ($user);
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
                <?php foreach($usuario as $us) ?>

                <form action="conexionbbdd.php" method="GET">
                    <label for="">Nombre</label><br>
                    <input type="text" placeholder=<?=$usuario['']  ?>><br>
                    <label for="">login</label><br>
                    <input type="text" value="<?=$usuario['login']=='alberto'; ?>"><br>
                    <label for="">vehiculos</label><br>
                    <input type="text" value="<?=$usuario['login']; ?>"><br>
                </form>
            </ul>
        <?php endif; ?>
    </main>
</body>
</html>