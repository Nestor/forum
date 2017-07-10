<?php
try {
    $connexion = new PDO('mysql:host=localhost;port=3306;dbname=forumDB;charset=UTF8', 'root', 'root');
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(Exception $e) {
    echo $e->getMessage();
}
?>