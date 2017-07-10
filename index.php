<?php

session_start();
/* Dissocier la connexion du reste des fonction ça à l'air bien mais ça engendrera des problèmes dans notre système
 * Car on aura un cas de figure si on appel ceci de l'index.php ou si on l'appel depuis un service.
 */
include_once 'configuration/config.php';
include_once 'model/fonctions.php';
$page = getPage();

switch($page) {
    case "accueil":
        $dones = GetDataForum();
        include 'view/accueil.php';
    break;
    case "profil":
        $utilisateur = loadUsersProfil($_GET['id']);
        include 'view/profil.php';
    break;
    case "register":
        include 'view/register.php';
    break;
    case "mp":
        $utilisateur = loadUsersProfil($_GET['id']);
        include 'view/privateMessage.php';
    break;
    case "sujet";
        $data = GetDataSujet($_GET['category']);
        include 'view/sujet.php';
    break;
    case "read_sujet":
        $data = GetSujetData($_GET['id']);
        include 'view/readSujet.php';
    break;
}
?>