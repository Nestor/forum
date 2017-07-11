<?php

    function getPage(){
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = "accueil";
        }
        return $page;
    }
    function MYSQLConnexion() {
        try {
            $connexion = new PDO('mysql:host=localhost;port=3306;dbname=forumDB;charset=UTF8', 'root', 'root');
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $connexion;
        } catch(Exception $e) {
            die("MYSQL: ".$e->getMessage());
        }
    }
    function userConnexion($username, $password){
        /*
        * C'est bien vu de vouloir séparer la connexion du reste des fonction mais c'est plutot les crédentielles user
        * que tu veux mettre dans le fichier config et pas forcément la connexion
        * tu peux faire ici dans fonctions.php une fonction getConnexion() qui te donnera la connexion
        * ensuite si tu veux avoir les crédentiel dans le dossier config tu auras un cas de figure pour l'index.php
        * et pour les services car les chemins relatifs ne seront pas les même.
        * dans getConnexion() tu peux scanner les dossier et faire deux cas de figure je pense.
        *
        * Alfonso: faire des includes comme ça dans les fonctions c'est un peu moche. Plutot tu devrais appeler une
         * fonction getConnexion() à chaque fois. À toi de voir une solution pour n'avoir qu'une seule connexion
        */

        $connexion=MYSQLConnexion();

        /* Alfonso: is un username est empty ou pas doit être vérifié dans un service et pas dans cette
         * fonction. Tes services doivent être plus plein avec des if et des conditions qui font
         * les vérifications.
         * */
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
                    'username' => $user[0]['username'],
                    'grade' => $user[0]['grade']
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
         $connexion=MYSQLConnexion();
         $object = $connexion->prepare('SELECT * FROM users WHERE id=:id');
         $object->execute(array(
             'id' => $id
         ));
         $user = $object->fetchAll(PDO::FETCH_ASSOC);
         $result = $object->rowCount();

         if (!$result == 0) {
             return $user;
         } else {
             /*
              * Alfonso: ce genre de contrôle doit être fait dans le service
              * et le feedback rapporté au user
              * */
             echo 'Aucune données pour ce compte';
         }
    }

    function userRegister($username, $password, $email){
        $connexion=MYSQLConnexion();
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
            /*
            * Alfonso: Les redirections doivent être faites dans un service plutot que dans une fonction
            * */
            header('location: ../index.php?page=register&etat=success');
        } else {
            header('location: ../index.php?page=register&etat=exist');
        }
    }

    function GetDataForum() {
        $connexion=MYSQLConnexion();

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
        /*
         * Alfonso: ces fonction qui crée de l'html doivent être dans un template de préférence. Si c'est des bloques qui reviennent
         * il y a moyen d'en faire des templates également. Ça a plus de sens si on veut jouer avec ces bloques dans les templates
         * plutot que devoir chercher dans quel fonction est un menu.
         *
         * Même observation pour les fonctions successives.
         * */
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
        $connexion=MYSQLConnexion();

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
            
            <div class="sujet">
                <div class="name_sujet">
                    <p><a href="index.php?page=read_sujet&id='.$sujet_id.'">'.$sujet_titre.'</a></p>
                </div>
                <div class="date"><p>'.$sujet_date.'</p></div>
                <div class="user"><p>'.$sujet_user_id.'</p></div>
            </div>
            ';
        }
        return $dataHTML;
    }

    function GetUsername($id) {
        $connexion=MYSQLConnexion();

        $object = $connexion->prepare('SELECT username FROM users WHERE id = :id');
        $object->execute(array(
            "id" => intval($id)
        ));
        $result = $object->fetch();
        return $result;
        print_r($result);
        $result->closeCursor();
    }
    
    function getAllUsers() {
        $connexion=MYSQLConnexion();

        $object = $connexion->prepare('SELECT id, username, grade FROM users');
        $object->execute();
        $data = $object->fetchAll(PDO::FETCH_ASSOC);

        // return $data;
        $dataHTML = "";
        foreach($data as $value) {
            $dataHTML .= '
            <div class="userline">
            <div class="username"><a href="index.php?page=profil&id='.$value['id'].'">'.$value['username'].'</a></div>
            <div class="usergrade">'.$value['grade'].'</div>
            </div>
            ';
        }
        return $dataHTML;
    }
        
    function GetResponseFromSujet($id) {
        $connexion=MYSQLConnexion();
        // SELECT * FROM sujet INNER JOIN sujet_response ON sujet.sujet_id= sujet_response.msg_sujet_id
        $object = $connexion->prepare('SELECT * FROM sujet_response WHERE msg_sujet_id=:id');
        $object->execute(array(
            "id" => $id
        ));
        $data = $object->fetchAll(PDO::FETCH_ASSOC);

        $dataHTML = "";
        foreach($data as $value){
            $dataHTML .= '<div class="responseSujet">
            <div class="header">
                <div class="poste_username"><p>Poster par '.$value['msg_user_name'].'</p></div>
                <div class="poste_date"><p>Le '.$value['msg_date'].'</p></div>
            </div>
            <div class="container">
                <p>'.$value['msg_contenue'].'</p>
            </div>
            </div>';
        }
        return $dataHTML;
    }
    function GetSujetData($id) {
        $connexion=MYSQLConnexion();
        // SELECT * FROM sujet INNER JOIN sujet_response ON sujet.sujet_id= sujet_response.msg_sujet_id
        $object = $connexion->prepare('SELECT * FROM sujet WHERE sujet_id=:id');
        $object->execute(array(
            "id" => $id
        ));
        $data = $object->fetchAll(PDO::FETCH_ASSOC);

        $dataHTML = "";
        foreach($data as $value){
            $dataHTML .= '<div class="sujet">
            <div class="titre"><p>'.$value['sujet_titre'].' | poster le '.$value['sujet_date'].'</p></div>
            <div class="container">'.$value['sujet_contenue'].'</div>
            </div>
            ';
        }
        return $dataHTML;
    }

?>