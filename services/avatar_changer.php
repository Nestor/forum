<?php
    include '../model/fonctions.php';
    $result = changeAvatar($_FILES['uploadedfile'], $_POST['id_user']);

    switch($result){
        case "successavatar":
            header('location: ../index.php?page=profil&id='.$_POST['id_user'].'&etat=successavatar');
            die();
        break;
        case "erroravatar":
            header('location: ../index.php?page=profil&id='.$_POST['id_user'].'&etat=erroravatar');
            die();
        break;
        case "maxsizeavatar":
            header('location: ../index.php?page=profil&id='.$_POST['id_user'].'&etat=maxsizeavatar');
            die();
        break;
    }
?>