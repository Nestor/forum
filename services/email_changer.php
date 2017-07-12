<?php

    if(!empty($_POST['email'])){
        include '../model/fonctions.php';
        $result = changeMail($_POST['id_user'], $_POST['email']);
        if ($result >= 1) {
            header('location: ../index.php?page=profil&id='.$_POST['id_user']);
        } else {
            header('location: ../index.php?page=profil&etat=error&id='.$_POST['id_user']);
        }
        
    } else {
        header('location: ../index.php?page=profil&etat=error_mail&id='.$_POST['id_user']);
    }

?>