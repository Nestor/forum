<?php
session_start();
include_once 'configuration/config.php';
include_once 'model/fonctions.php';


if ( isset($_GET['page']) ){
    $page = $_GET['page'];
} else {
    $page = "accueil";
}


switch($page) {
    case "accueil":
        include 'view/accueil.php';
    break;
}
?>