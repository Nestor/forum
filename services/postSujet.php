<?php

    include '../model/fonctions.php';
    $connexion = MYSQLConnexion();
    $object = $connexion->prepare('INSERT INTO sujet SET sujet_id_sous_categorie=:scID, sujet_titre=:titre, sujet_contenue=:contain, sujet_date=:date, sujet_user_id=:userID');

    $dataToday = date('d/m/y');

    $object->execute(array(
        "scID" => $_POST['idSCategorie'],
        "titre" => $_POST['titre'],
        "contain" => $_POST['contenue'],
        "date" => $dataToday,
        "userID" => $_POST['userID']
    ));

    header('location: ../index.php?page=sujet&category='.$_POST['idSCategorie']);
?>