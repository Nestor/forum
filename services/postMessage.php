<?php

    include '../configuration/config.php';
    $object = $connexion->prepare('INSERT INTO sujet_response SET msg_sujet_id=:sujetid, msg_contenue=:contenue, msg_date=:dataToday, msg_user_id=:userID');
    $dataToday = date('d/m/y');
    $sujetID = $_POST['sujet_id'];
    $object->execute(array(
        "sujetid" => $sujetID,
        "contenue" => htmlentities($_POST['contenue']),
        "dataToday" => $dataToday,
        "userID" => htmlentities($_POST['user_id'])
    ));

    header('location: ../index.php?page=read_sujet&id='.$sujetID);
?>