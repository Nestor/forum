<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceuil</title>
    <script type="text/javascript" src="scripts/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="styles/css/style.css" />
</head>
<body>
    <div class="container-parent">
        <!-- Espace membres -->
        <?php if(isset($_SESSION['user'])) { ?>
            <div class="container red">
                <?php
                    if (isset($utilisateur)) {
                        echo 'Username: '.$utilisateur[0]['username'].'<br/>';
                        echo 'Email: '.$utilisateur[0]['email'].'<br/>';
                        echo '<img src="../Forum/styles/'.$utilisateur[0]['path_avatar'].'" alt="avatar" style="width: 200px;height: 200px;"/><br/>';
                        echo 'Compte créer le: '.$utilisateur[0]['date_creation'].'<br/>';
                    }
                ?>
                <!--<div class="header">Profil de <?= $utilisateur[0]['username'] ?></div>-->
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