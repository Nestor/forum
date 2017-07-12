<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Profil</title>
</head>
<body>
    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>
        <!-- Espace membres -->
        <?php if(isset($_SESSION['user'])) { ?>
            <div class="container red">


                <div id="profilPage">
                    <?php if (isset($utilisateur)) { ?>
                    <div class="main">
                        <img src="ancien_Forum/<?=$utilisateur[0]['path_avatar']?>" alt="avatar" class="avatar"/>
                    </div>
                    <div class="container">
                        <div class="header"><p><?=$utilisateur[0]['username']?></p></div>
                                <?php
                                if(isset($_GET['etat'])){
                                    switch($_GET['etat']) {
                                        case "error_mail":
                                        echo 'Veuillez remplir tout les champs<br/>';
                                        break;
                                        case "error":
                                        echo 'Impossible d\'éditer le profil<br/>';
                                        break;

                                        case "maxsizeavatar":
                                        echo 'Impossible d\'éditer le profil<br/>';
                                        break;
                                        case "erroravatar":
                                        echo 'Impossible d\'éditer le profil<br/>';
                                        break;
                                        case "successavatar":
                                        echo 'Avatar changer<br/>';
                                        break;
                                    }
                                }
                                ?>
                                Email: <?=$utilisateur[0]['email']?><br/>
                                Compte créer le: <?=$utilisateur[0]['date_creation']?><br/>
                                Grade: <?=$utilisateur[0]['grade']?>

                                <?php
                                    if($_GET['id'] == $_SESSION['user']['id']){
                                        echo '<a href="index.php?page=profil_edit&id='.$_SESSION['user']['id'].'">Editer le profil</a>';
                                    }
                                ?>
                                
                    <?php } ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="container red">
                <div class="header">Erreur connexion</div>
                <h2>Veuillez vous connecter</h2>
            </div>
        <?php } ?>
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>