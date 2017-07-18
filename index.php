<?php

session_start();

include_once 'model/fonctions.php';
$page = getPage();

/**
 * Alfonso: Oui on aurait pu mettre le switch dans une autre fonction mais si on suit un logique
 * MVC on aurait pu mettre dans un fichier appart ce switch pour le séparer des fonctions
 */

navigation($page);



?>