<?php
session_start();
include_once 'configuration/config.php';
include_once 'model/fonctions.php';
$page = getPage();



switch($page) {
    case "accueil":
        include 'view/accueil.php';
    break;
    case "profil":
        $utilisateur = loadUsersProfil($_GET['id']);
        include 'view/profil.php';
    break;
    case "register":
        include 'view/register.php';
    break;
}
?>