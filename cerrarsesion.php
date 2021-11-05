<?php
    session_start();
    session_destroy();

    header("Location: logging.php ");
?>