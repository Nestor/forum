<?php

    session_start();
    session_destroy();
    header('location: ../index.php?page=space_member&etat=disconnect');
    die();
?>