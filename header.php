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
        session_start();    
        $_SESSION['username'];
        $_SESSION['password'];
?>
</head>
<body>
    
    <div class="header">
        <a href="logging.php" class="logo"><h1>MECANICOS EDUARDO</h1></a>

        <h3><?php 
            if (session_status()==2) {
                echo $_SESSION['username'];
            }
        ?></h3>
    </div>

    <div class="footer">
        <p>Todos los berberechos reservador</p>
    </div>
</body>
</html>