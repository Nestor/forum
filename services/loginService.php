<?php
    session_start();
    include '../model/fonctions.php';

    //Alfonso: il faut que dans les services tu aies des checking du genre if les mots de passe
    // sont empty() pas dans les fonctions
    // la logique checking générale doit être dans les services.

    userConnexion($_POST['account'], $_POST['password']);
?>