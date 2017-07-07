<?php

    function getPage(){
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = "accueil";
        }
        return $page;
    }

    function userConnexion($username, $password){
        include '../configuration/config.php';

        if (!empty($username) && !empty($password)) {

            $object = $connexion->prepare('SELECT * FROM users WHERE username=:username');
            $object->execute(array(
                'username' => htmlentities($username)
            ));
            $user = $object->fetchAll(PDO::FETCH_ASSOC);

            if ($user[0]['username'] == $username && $user[0]['password'] == $password) {
                $_SESSION['user'] = [
                    'id' => $user[0]['id'],
                    'username' => $user[0]['username']
                ];
                header('location: ../index.php');
            } else {
                header('location: ../index.php?etat=error');
            }

            print_r($user);
        } else {
            echo 'Veuillez remplir tout les champs';
        }


    }

    function loadUsersProfil($id) {
         include 'configuration/config.php';
         $object = $connexion->prepare('SELECT * FROM users WHERE id=:id');
         $object->execute(array(
             'id' => $id
         ));
         $user = $object->fetchAll(PDO::FETCH_ASSOC);
         $result = $object->rowCount();

         if (!$result == 0) {
             return $user;
         } else {
             echo 'Aucune données pour ce compte';
         }
    }
?>