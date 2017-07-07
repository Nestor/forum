<?php
    include '../model/fonctions.php';
    if (!empty($_POST['account']) && !empty($_POST['password']) && !empty($_POST['email'])) {

        $username = htmlentities($_POST['account']);
        $password = htmlentities($_POST['password']);
        $email = htmlentities($_POST['email']);

        userRegister($username, $password, $email);
    } else {
        header('location: ../Forum/index.php?page=register&etat=error');
    }

?>