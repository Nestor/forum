<?php
    session_start();
    include '../model/fonctions.php';
    userConnexion($_POST['account'], $_POST['password']);
?>