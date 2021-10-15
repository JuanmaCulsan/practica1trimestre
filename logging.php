<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <form class="form" action="datos_usuario.php" method="GET">
                <h1>¡Bienvenido!</h1>
                <input type="text" name="id_usu" class="username">
                <br>
                <!--
                <input type="text" name="pass" class="username">
                <input type="submit" class="submit" value="aceptar">
                -->
                <p>Eres nuevo/a <a href="nuevo_usuario.php">pincha aqui</a>
            </form>
        </div>
    </div>
</body>
</html>