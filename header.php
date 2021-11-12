<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            padding: 0px;
            margin: 0px;
        }
        .header{
            background: -webkit-linear-gradient(90deg, yellow 10%, orange 90%);
            background: -moz-linear-gradient(90deg, yellow 10%, orange 90%);
            background: -ms-linear-gradient(90deg, yellow 10%, orange 90%);
            background: -o-linear-gradient(90deg, yellow 10%, orange 90%);
            background: linear-gradient(90deg, yellow 10%, orange 90%);
            overflow: hidden;
        }

        .header h1,.header a{
            width: 80%;
            text-align: center;
            align-content: center;
            margin-left:10%;
            float: left;
        }

        h1{
            text-decoration: none;
            color: black;
        }

        .logo{
            text-decoration: none;
            color: black;
        }

        .footer{
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #23bac4;
            color: white;
            text-align: center;
            font-size: 20px;
        }

        h3{
            float: right;
            display: inline;
            margin-right: 2%;
        }
    </style>

<?php 
        session_start();  //inicio la sesion, pero no la creo  
?>
</head>
<body>
    
    <div class="header">

        <?php if (! empty($_SESSION['username'])): //en caso de que la sesion este iniciada, podremos cerrar la sesion en el titulo ?>
            <a href="cerrarsesion.php"><h1>MECANICOS EDUARDO</h1></a>
        <?php else: //si la sesion no esta iniciada no hace falta cerrarla ?>
            <a href="logging.php"><h1>MECANICOS EDUARDO</h1></a>
        <?php endif?>
            <?php if (isset($_SESSION['username'])): //en este if se comprueba si podemos conseguir el username de la sesion ?>
            <h3><?php 
                echo $_SESSION['username']; //en caso de que podamos conseguir los datos, saca por pantalla el username
            ?></h3>
            <?php
                $cookie=$_SESSION['username'].'cookie';
                //EL VALOR EN ESTE CASO CUANDO FUE EL ULTIMO MOMENTO EN EL QUE SE CONECTÓ
                $date = new Datetime();
                //lo cambio de formato para que sea legible 
                $valor = $date -> format('Y-m-d H:i:s');
                //el tiempo de la cookie
                $tiempo = time()+84600*30;
                setcookie("fecha_".$_SESSION['username'],$valor,$tiempo,"/");
            ?>
            <h3><?php
                if (isset($_SESSION['ultConn'])) {
                    echo $_SESSION['ultConn']; // justo debajo del username estará la última vez que se conectó
                }
                
            ?></h3>
            <?php endif?>
    </div>

    <div class="footer">
        <p>Todos los berberechos reservador</p>
    </div>
</body>
</html>