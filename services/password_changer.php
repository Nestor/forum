<?php
include '../model/fonctions.php';
if($_POST['password'] == $_POST['confirmPassword']) {

    if(strlen($_POST['password']) >= 8){
        $result = changePassword($_POST['id_user'], $_POST['ancienPassword'], $_POST['password']);

        if(intval($result) >= 1) {
            header('location: ../index.php?page=profil&etat=successpassword&id='.$_POST['id_user']);
            die();
        } else if($result=="difpassword") {
            // mot de passe différent
            header('location: ../index.php?page=profil&etat=difpassword&id='.$_POST['id_user']);
            die();
        } else {
            header('location: ../index.php?page=profil&etat=erreurpassword&id='.$_POST['id_user']);
            die();
        }
    } else {
        header('location: ../index.php?page=profil&etat=lengthpassword&id='.$_POST['id_user']);
    }

    

} else {
    header('location: ../index.php?page=profil&etat=passwordident&id='.$_POST['id_user']);
    die();
}

?>