<pre>
    <?php
        
        $db_host = "localhost";
        $db_name = "practica1php";
        $db_user = "practica1php";
        $db_pass = "edupablojuanma";
        
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        
        if (mysqli_connect_error()) {
            echo mysqli_connect_error();
            exit;
        }      
        echo "Connected successfully.";


        $codigo = $_GET['name'];
        
        $sql = "SELECT *
                FROM listausuario
                where nombreuser = '$codigo'
                ORDER BY coduser";
    
        $results = mysqli_query($conn, $sql);
        

        if ($sql) {
            echo mysqli_error($conn);
        } else {
            $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
    
            print_r($users);
        }
    ?>
</pre>
