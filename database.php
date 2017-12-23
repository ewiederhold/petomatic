<?php
    #CONNECT TO THE CALENDAR DATABASE
    $mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'dogFeeder');

    if($mysqli->connect_errno){
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
    }
?>
