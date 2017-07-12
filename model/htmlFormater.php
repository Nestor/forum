<?php

function sous_category($id, $name){
    return '<div class="subject"><div class="name"><a href="index.php?page=sujet&category='.$id.'">'.$name.'</a></div></div>';
}

function sujet_line($id, $titre, $date, $user){
    return '<div class="sujet">
                <div class="name_sujet">
                    <p><a href="index.php?page=read_sujet&id='.$id.'">'.$titre.'</a></p>
                </div>
                <div class="date"><p>'.$date.'</p></div>
                <div class="user"><p>'.$user.'</p></div>
            </div>
    ';
}
function sujet($titre, $date, $contenue){
    return '<div class="sujet">
            <div class="titre"><p>'.$titre.' | poster le '.$date.'</p></div>
            <div class="container">'.$contenue.'</div>
            </div>';
}
function sujet_response($username, $date, $contenue) {
    return '<div class="responseSujet">
            <div class="header">
                <div class="poste_username"><p>Poster par '.$username.'</p></div>
                <div class="poste_date"><p>Le '.$date.'</p></div>
            </div>
            <div class="container">
                <p>'.$contenue.'</p>
            </div>
            </div>';
}

function userline($id, $username, $grade){
    return '<div class="userline">
            <div class="username"><a href="index.php?page=profil&id='.$id.'">'.$username.'</a></div>
            <div class="usergrade">'.$grade.'</div>
            </div>';
}


?>