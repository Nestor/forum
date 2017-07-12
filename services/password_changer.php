<?php
include '../model/fonctions.php';
if($_POST['password'] == $_POST['confirmPassword']) {
    $result = changePasswdfsdford($_POST['id_user'], $_POST['ancienPassword'], $_POST['password']);
    print_r($result);
} else {
    echo 'Les mot de passe ne sont pas identique';
}

?>