<?php

session_start();

include_once 'model/fonctions.php';
$page = getPage();

navigation($page);
?>