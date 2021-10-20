<?php
    require("header.php");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registrar usuario</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="estilos/ccs_nuevo_usuario.css">


</head>
<body>
<form method="post">

    <h1>Registrate</h1>
    <input type="text" name="name" placeholder="Nombre">
    <input type="text" name="login" placeholder="Nombre de login">
    <input type="text" name="pass" placeholder="Contraseña">
    <input type="submit" name="register">
</form>

<?php
    include("nuevo_usuario.php");
    
?>

</body>




</html>