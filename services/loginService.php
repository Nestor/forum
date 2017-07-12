<?php
    session_start();
    include '../model/fonctions.php';

    if (!empty($_POST['account']) && !empty($_POST['password'])) {

        $etat = userConnexion($_POST['account'], $_POST['password']);

        if($etat["etat"] == "TRUE") {

            $_SESSION['user'] = [
                'id' => $etat['data']['id'],
                'username' => $etat['data']['username'],
                'grade' => $etat['data']['grade']
            ];

            header('location: ../index.php?page=space_member&etat=connect');
        } else {
            // echo 'Nom de compte ou mot de passe incorrect.';
            header('location: ../index.php?page=space_member&etat=error');
        }

    } else {
        header('location: ../index.php?page=space_member&etat=champempty');
    }
?>