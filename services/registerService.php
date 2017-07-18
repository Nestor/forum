<?php
    include '../model/fonctions.php';
    $etat_username = FALSE;
    $etat_password = FALSE;
    $etat_passwordC = FALSE;
    $etat_mail = FALSE;

    if(strlen($_POST['account']) >= 4 ){
        $etat_username = TRUE;
    } else {
        $etat_username = FALSE;
    }

    if(strlen($_POST['password']) >= 8){
        $etat_password = TRUE;
    } else {
        $etat_password = FALSE;
    }


    /**
     * Alfonso: il te manquait le passwordconfirm dans le formulaire.
     */
    if($_POST['password'] == $_POST['passwordconfirm']) {
        $etat_passwordC = TRUE;
    } else {
        $etat_passwordC = FALSE;
    }

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $etat_mail = TRUE;
    } else {
        $etat_mail = FALSE;
    }

/***
 * Alfonso: On aurait du prévoir un cas de figure ou on a un ces états (qui sont en fait des erreurs)
 * comme faux il aurait fallu renvoyer un else pour le premier "if"
 */

    if($etat_username == TRUE && $etat_password == TRUE && $etat_passwordC == TRUE && $etat_mail == TRUE) {
        $username = htmlentities($_POST['account']);
        $password = htmlentities($_POST['password']);
        $email = htmlentities($_POST['email']);

        $result = userRegister($username, $password, $email, $_POST['question'], $_POST['response']);

        if($result == "success") {
            header('location: ../index.php?page=space_member&etat=successins');
            die();
        } else if($result == "error") {
            header('location: ../index.php?page=space_member&etat=errorins');
            die();
        }
    }
?>