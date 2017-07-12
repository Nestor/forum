<?php
    include '../model/fonctions.php';
    if (!empty($_POST['account']) && !empty($_POST['password']) && !empty($_POST['email'])) {

        $username = htmlentities($_POST['account']);
        $password = htmlentities($_POST['password']);
        $email = htmlentities($_POST['email']);
        /*
         * Alfonso: il faut vérifier l'email avec un regex
         * il faut vérifier que le mot de passe à au moins 8 caractères
         * et le username au moins 4 caractères de long
         * */

        userRegister($username, $password, $email);
    } else {
        // Alfonso: essaie de mettre un die après un header même si ici ça n'a pas de sens car il n'y a pas de code après
        // c'est rare mais les script parfois mette trop de temps à s'executer et après un header() on ne veut pas
        // que ce qui a derrière s'execute. Donc par reflexe je met un die() toujours après un header()
        header('location: ../Forum/index.php?page=register&etat=error');
    }

?>