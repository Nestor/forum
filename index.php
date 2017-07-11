<?php

session_start();


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
        $data_test = GetSujedtData();
        print_r($data_test);
        die;
        include 'view/readSujet.php';
    break;
    case "create_sujet":
        $categorie_id = $_GET['category'];
        include 'view/createSujet.php';
    break;
    case "users_list":
        $users = getAllUsers();
        include 'view/usersList.php';
    break;

}
?>