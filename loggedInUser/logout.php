<?php
    #DESTROY THE SESSION AFTER IT'S STARTED
    session_start();
    session_destroy();
    header("Location:../petomatic.php");
    exit();
?>
