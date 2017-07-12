<?php

    include '../model/fonctions.php';
    $connexion = MYSQLConnexion();
    $object = $connexion->prepare('INSERT INTO sujet_response SET msg_sujet_id=:sujetid, msg_contenue=:contenue, msg_date=:dataToday, msg_user_id=:userID, msg_user_name=:name');
    $dataToday = date('d/m/y');
    $sujetID = $_POST['sujet_id'];
    $object->execute(array(
        "sujetid" => $sujetID,
         "contenue" => $_POST['contenue'],
        "dataToday" => $dataToday,
        "userID" => htmlentities($_POST['user_id']),
        "name" => $_POST['user_name']
    ));

    header('location: ../index.php?page=read_sujet&id='.$sujetID);
    die();
?>