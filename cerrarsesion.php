<?php //este archivo se llama para cerrar la sesión y volver al login
    session_start();
    session_destroy();

    header("Location: logging.php ");
?>