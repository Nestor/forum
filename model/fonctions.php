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

    function GetDataForum() {
        include 'configuration/config.php';

        $object = $connexion->prepare('SELECT * FROM categories c INNER JOIN sous_categories s ON c.id= s.id_categories');
        $object->execute();
        $data = $object->fetchAll(PDO::FETCH_ASSOC);

        /*
            Pour charger les catégories est les sous catégories
        */
        $formCatArray = array();
        $clef = array();
        /* Boucle pour liste nos catégories*/
        foreach($data as $initialise) {
            array_push($clef, $initialise['categorie']);
        }
        $formCatArray = array_fill_keys($clef, null); // ici on assigne les clef

        /* On remplie l'array à l'aide des clef*/
        foreach($data as $donnees) {
            if(!in_array($donnees['categorie'], $formCatArray)){
                $formCatArray[$donnees['categorie']][] .= $donnees['id']."#".$donnees['name'];
            }
        }
        //print_r($formCatArray);
        $dataHTML = "";
        foreach($formCatArray as $key => $catego) {
            $dataHTML .= '<div class="categorie"><div class="header"><p>'.$key.'</p></div>';
            foreach($catego as $sous_cat) {
                $resultSousCat = explode("#",$sous_cat);
                $id_categorie = $resultSousCat[0];
                $name_categorie = $resultSousCat[1];

                $dataHTML .= '<div class="subject"><div class="name"><a href="index.php?page=sujet&category='.$id_categorie.'">'.$name_categorie.'</a></div></div>';
            }
            $dataHTML .= '</div>';
        }
        return $dataHTML;
        
    }
    
    function GetDataSujet($id) {
        include 'configuration/config.php';

        $object = $connexion->prepare('SELECT * FROM sous_categories INNER JOIN sujet ON sujet.sujet_id_sous_categorie = :id');
        $object->execute(array(
            "id" => intval($id)
        ));
        $data = $object->fetchAll(PDO::FETCH_ASSOC);
        $sujetForum = [];

        foreach($data as $key => $donnees) {
            $donneesVar = $donnees['sujet_id'].'#'.$donnees['sujet_titre'].'#'.$donnees['sujet_contenue'].'#'.$donnees['sujet_date'].'#'.$donnees['sujet_user_id'].'#'.$donnees['sujet_id_sous_categorie'];
            if (!in_array($donneesVar, $sujetForum)) {
                $sujetForum[] .= $donneesVar;
            }
            
        }

        $dataHTML = "";
        foreach($sujetForum as $value) {

            $dataSplited = explode("#",$value);
            $sujet_id = $dataSplited[0];
            $sujet_titre  = $dataSplited[1];
            $sujet_contenue = $dataSplited[2];
            $sujet_date = $dataSplited[3];
            $sujet_user_id = $dataSplited[4];
            $sujet_id_sous_categorie = $dataSplited[5];

            $dataHTML .= '
            <div class="subject">
                <div class="name_sujet">
                    <a href="index.php?page=read_sujet&id='.$sujet_id.'">'.$sujet_titre.'</a>
                </div>
                <div class="date">'.$sujet_date.'</div>
                <div class="user">'.$sujet_user_id.'</div>
            </div>
            ';
        }
        return $dataHTML;
    }

    function GetUsername($id) {
        include 'configuration/config.php';

        $object = $connexion->prepare('SELECT username FROM users WHERE id = :id');
        $object->execute(array(
            "id" => intval($id)
        ));
        $result = $object->fetch();
        return $result;
        print_r($result);
        $result->closeCursor();
    }
    
    function GetSujetData($id) {
        include 'configuration/config.php';

        $object = $connexion->prepare('SELECT * FROM sujet WHERE sujet_id = :id');
        $object->execute(array(
            "id" => intval($id)
        ));
        $data = $object->fetchAll(PDO::FETCH_ASSOC);
        // sujet_id: "1",
        // sujet_id_sous_categorie: "1",
        // sujet_titre: "test",
        // sujet_contenue: "bonjour à tous",
        // sujet_date: "09/07/17",
        // sujet_user_id: "0"
        foreach($data as $value) {
            return '<div class="sujet">
            <div class="titre"><p>'.$value['sujet_titre'].' | poster le '.$value['sujet_date'].'</p></div>
            <p>'.$value['sujet_contenue'].'</p>
            </div>
            ';

        }
        
    }

    function getAllUsers() {
        include 'configuration/config.php';

        $object = $connexion->prepare('SELECT username FROM users');
        $object->execute();
        $data = $object->fetchAll(PDO::FETCH_ASSOC);

        // return $data;
        $dataHTML = "";
        foreach($data as $value) {
            $dataHTML .= '<div class="subject"><div class="users">'.$value['username'].'</div></div>';
        }
        return $dataHTML;
    }
        
        function GetSujedtData() {
        include 'configuration/config.php';

        $object = $connexion->prepare('SELECT * FROM sujet INNER JOIN sujet_response ON sujet.sujet_id= sujet_response.msg_sujet_id');
        $object->execute();
        $data = $object->fetchAll(PDO::FETCH_ASSOC);

        // sujet_id: "2"
        // sujet_id_sous_categorie: "5",
        // sujet_titre: "teste des sujet",
        // sujet_contenue: "ceci est un teste afin de remplir le forum est de le design",
        // sujet_date: "10/07/17",
        // sujet_user_id: "1",
        // msg_id: "1",
        // msg_sujet_id: "2",
        // msg_contenue: "&lt;p&gt;bonjour &amp;agrave; tous&lt;/p&gt;",
        // msg_date: "10/07/17",
        // msg_user_id: "1"
        $dataHTML = "";
        foreach($data as $value){
            $dataHTML .= '[titre]'.$value['sujet_titre'].'[/titre]';
        }
        return $data;
        
    }

?>