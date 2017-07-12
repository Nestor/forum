<?php

    if(!empty($_POST['email'])){
        include '../model/fonctions.php';

        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $result = changeMail($_POST['id_user'], $_POST['email']);
            if ($result >= 1) {
                header('location: ../index.php?page=profil&id='.$_POST['id_user']);
                die();
            } else {
                header('location: ../index.php?page=profil&etat=error&id='.$_POST['id_user']);
                die();
            }
        } else {
            header('location: ../index.php?page=profil&etat=invalidmail&id='.$_POST['id_user']);
        }
        
        
    } else {
        header('location: ../index.php?page=profil&etat=error_mail&id='.$_POST['id_user']);
        die();
    }

?>