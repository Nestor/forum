<?php
include '../model/fonctions.php';
$result = retrievePassword($_POST['question'], $_POST['response'], $_POST['account']);
if($result == "error") {
    header('location: ../index.php?page=retrievepassword&password=error');
    die();
} else {
    header('location: ../index.php?page=retrievepassword&password='.$result);
    die();
}
?>