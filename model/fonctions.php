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
        /*
        * C'est bien vu de vouloir séparer la connexion du reste des fonction mais c'est plutot les crédentielles user
        * que tu veux mettre dans le fichier config et pas forcément la connexion
        * tu peux faire ici dans fonctions.php une fonction getConnexion() qui te donnera la connexion
        * ensuite si tu veux avoir les crédentiel dans le dossier config tu auras un cas de figure pour l'index.php
        * et pour les services car les chemins relatifs ne seront pas les même.
        * dans getConnexion() tu peux scanner les dossier et faire deux cas de figure je pense.
        */
        include '../configuration/config.php';

        if (!empty($username) && !empty($password)) {

            $object = $connexion->prepare('SELECT * FROM users WHERE username=:username');
            $object->execute(array(
                'username' => htmlentities($username)
            ));
            $user = $object->fetchAll(PDO::FETCH_ASSOC);

            if ($user[0]['username'] == $username && $user[0]['password'] == $password) {
                // Alfonso: peut être tu devrais setter la session
                // dans le service plutot. C'est sur comment tu as fait laisse le service super clean
                // mais du coup on ne sait pas ce que fait exactement le service.
                // donc tous ce qui est dans le if() et les redirections en passant par le setting de la session
                // doit être fait dans  le service.
                // également la construction du feedback
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

    function userRegister($username, $password, $email){
        include '../configuration/config.php';
        $date_creation = date("d/m/y");


        $object = $connexion->prepare('SELECT * FROM users WHERE username=:username');
        $object->execute(array(
            "username" => $username
        ));

        if (!$object->rowCount() == 1) {
            $object = $connexion->prepare('INSERT INTO users SET username=:username, password=:password, email=:email, path_avatar=:avatar, date_creation=:date_create');
            $object->execute(array(
                "username" => $username,
                "password" => $password,
                "email" => $email,
                "avatar" => "images/empty_avatar.png",
                "date_create" => $date_creation
            ));
            header('location: ../index.php?page=register&etat=success');
        } else {
            header('location: ../index.php?page=register&etat=exist');
        }
    }

    function GetForumData() {
        include '../configuration/config.php';
        //$object = $connexion->prepare('SELECT * FROM user WHERE id=:userId');
        
        // SELECT j.nom nom_jeu, p.prenom prenom_proprietaire
        // FROM proprietaires p, jeux_video j
        // WHERE j.ID_proprietaire = p.ID


        // SELECT j.nom nom_jeu, p.prenom prenom_proprietaire
        // FROM proprietaires p
        // INNER JOIN jeux_video j
        // ON j.ID_proprietaire = p.ID

        // SELECT * FROM categories c INNER JOIN sous_categories s ON s.id_categories= c.id
        // SELECT c.categorie FROM categories c INNER JOIN sous_categories s ON s.id_categories = c.id
        $object = $connexion->prepare('SELECT * FROM categories c INNER JOIN sous_categories s ON s.id_categories= c.id');
        // SELECT id_categories 
        $object->execute();
        $data = $object->fetchAll(PDO::FETCH_ASSOC);


        print_r($data);


        echo $data[0]['categorie'].'->'.$data[0]['categorie'];
    }
    /* Alfonso: je suppose que cet appel est pour tester ta fonction. Mais évidemment ça ne doit pas être ici */
    GetForumData();
?>