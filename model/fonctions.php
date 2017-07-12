<?php
    include 'htmlFormater.php';

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
        $connexion=MYSQLConnexion();

            $object = $connexion->prepare('SELECT * FROM users WHERE username=:username');
            $object->execute(array(
                'username' => htmlentities($username)
            ));
            $user = $object->fetchAll(PDO::FETCH_ASSOC);


        /***
         * Alfonso: est-ce judicieux de créer un tableau comme ça ici??
         * telle est la question... on en a déjà parler je pense
         * Melvin: je veut le changer mais je ne sais pas si j'aurais le temps
         */
            if($object->rowCount() >= 1) {
                if ($user[0]['username'] == $username && $user[0]['password'] == $password) {
                    $tableau = [
                        "etat" => "TRUE",
                        "data" => [
                            'id' => $user[0]['id'],
                            'username' => $user[0]['username'],
                            'grade' => $user[0]['grade']
                        ]
                    ];
                    return $tableau;
                }
            } else {
                $tableau = [
                    "etat" => "FALSE",
                    "data" => []
                ];
                return $tableau;
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
         }
    }

    function userRegister($username, $password, $email, $question, $reponse){
        $connexion=MYSQLConnexion();
        $date_creation = date("d/m/y");


        $object = $connexion->prepare('SELECT * FROM users WHERE username=:username');
        $object->execute(array(
            "username" => $username
        ));

        if (!$object->rowCount() == 1) {
            $object = $connexion->prepare('INSERT INTO users SET username=:username, password=:password, email=:email, path_avatar=:avatar, grade=:grade, question=:quest, reponse=:resp ,date_creation=:date_create');
            $object->execute(array(
                "username" => $username,
                "password" => $password,
                "email" => $email,
                "avatar" => "../styles/images/avatars/empty_avatar.png",
                "grade" => "user",
                "quest" => htmlentities($question),
                "resp" => htmlentities($reponse),
                "date_create" => $date_creation
            ));
            return "success";
        } else {
            return "error";
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
        $dataHTML = "";
        foreach($formCatArray as $key => $catego) {
            $dataHTML .= '<div class="categorie"><div class="header"><p>'.$key.'</p></div>';
            foreach($catego as $sous_cat) {
                $resultSousCat = explode("#",$sous_cat);
                $id_categorie = $resultSousCat[0];
                $name_categorie = $resultSousCat[1];

                $dataHTML .= sous_category($id_categorie, $name_categorie);
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
            $donneesVar = $donnees['sujet_id'].'#'.$donnees['sujet_titre'].'#'.$donnees['sujet_contenue'].'#'.$donnees['sujet_date'].'#'.$donnees['sujet_user_id'].'#'.$donnees['sujet_id_sous_categorie'].'#'.$donnees['sujet_user_name'];
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
            $sujet_user_name = $dataSplited[6];

            $dataHTML .= sujet_line($sujet_id, $sujet_titre, $sujet_date, $sujet_user_name);
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
            $dataHTML .= userline($value['id'], $value['username'], $value['grade']);
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
            $dataHTML .= sujet_response($value['msg_user_name'], $value['msg_date'], $value['msg_contenue']);
        }
        return $dataHTML;
    }
    
    function GetSujetData($id) {
        $connexion=MYSQLConnexion();
        $object = $connexion->prepare('SELECT * FROM sujet WHERE sujet_id=:id');
        $object->execute(array(
            "id" => $id
        ));
        $data = $object->fetchAll(PDO::FETCH_ASSOC);

        $dataHTML = "";
        foreach($data as $value){
            $dataHTML .= sujet($value['sujet_titre'], $value['sujet_date'], $value['sujet_contenue']);
        }
        return $dataHTML;
    }

    function changeMail($id, $email){
        
        $connexion=MYSQLConnexion();
        $object = $connexion->prepare('UPDATE users SET email=:mail WHERE id=:id');
        $object->execute(array(
            "mail" => $email,
            "id" => $id
        ));

        return $object->rowCount();
    }

    function changeAvatar($avatar, $id){

        $connexion=MYSQLConnexion();
        $target_path = "../styles/images/avatars/";
        $target_path = $target_path . basename( $avatar['name']);

        if(move_uploaded_file($avatar['tmp_name'], $target_path)) {

            $object = $connexion->prepare('UPDATE users SET path_avatar=:avatar WHERE id=:id');
            $object->execute(array(
                "avatar" => $target_path,
                "id" => $id
            ));

            return "successavatar";

        } else {
            return "erroravatar";
        }

        if ($avatar['size'] <= 1000000) {
                
            $infosfichier = pathinfo($avatar['name']);

            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees))
            {
                $newName = hash('sha1',$avatar['name']).'.'.$extension_upload;
                move_uploaded_file($avatar['tmp_name'], 'uploads/' . basename($newName));
                $object = $connexion->prepare('UPDATE users SET path_avatar=:avatar WHERE id=:id');
                $object->execute(array(
                    "avatar" => $target_path,
                    "id" => $id
                ));
                return "successavatar";
            }
        }else{
            return "maxsizeavatar";
        }
    }

    function changePassword($id, $lastPassword, $newPassword) {
        $connexion=MYSQLConnexion();
        $request = $connexion->prepare('SELECT password FROM users WHERE id=:id');
        $request->execute(array(
            "id" => $id
        ));
        $data = $request->fetch(PDO::FETCH_ASSOC);

        if($lastPassword == $data['password']){
            $object = $connexion->prepare('UPDATE users SET password=:password WHERE id=:id');
            $object->execute(array(
                "password" => $newPassword,
                "id" => $id
            ));
            return $object->rowCount();
        } else {
            return "difpassword";
        }
    }

    function retrievePassword($question, $reponse, $username) {

        $connexion=MYSQLConnexion();
        $object = $connexion->prepare('SELECT question, reponse, username, password FROM users WHERE username=:name');

        $object->execute(array(
             'name' => $username
        ));

        $data = $object->fetch(PDO::FETCH_ASSOC);
        $result = $object->rowCount();

        if($result >= 1) {
            if($question == $data['question'] && $reponse == $data['reponse']) {
                return $data['password'];
            } else {
                return "error";
            }
        } else {
            return "error";
        }

    }

    /* erreur code de l'edit profil */
    function Getetat($errCode){
        if(isset($errCode)){
            switch($errCode) {
                case "error_mail":
                    return 'Veuillez remplir tout les champs<br/><br/>';
                break;
                case "error":
                    return 'Impossible d\'éditer le profil<br/><br/>';
                break;

                case "maxsizeavatar":
                    return 'Impossible d\'éditer le profil<br/><br/>';
                break;
                case "erroravatar":
                    return 'Impossible d\'éditer le profil<br/><br/>';
                break;
                case "successavatar":
                    return 'Avatar changer<br/><br/>';
                break;

                case "successpassword":
                    return 'Le mot de passe à était changer<br/><br/>';
                break;
                case "difpassword":
                    return 'L\'ancien mot de passe ne correspond pas<br/><br/>';
                break;
                case "erreurpassword":
                    return 'L\'ancien mot de passe ne correspond pas<br/><br/>';
                break;
                case "passwordident":
                    return 'Les mot de passe ne sont pas identique<br/><br/>';
                break;
                case "lengthpassword":
                    return 'Mot de passe pas assez long<br/><br/>';
                break;
                case "invalidmail":
                    return 'Format de mail invalide<br/><br/>';
                break;
            }
        }
    }
?>