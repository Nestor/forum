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
        <div class="container green">
            <?php if (isset($_SESSION['user'])) { ?>
                <div class="header">Bienvenue 
                <a href="index.php?page=profil&id=<?=$_SESSION['user']['id']?>" title="Profil page"><?= $_SESSION['user']['username'] ?></a>
                 | 
                <a href="index.php?page=mp&id=<?=$_SESSION['user']['id']?>" title="Message privée">Message privée</a>
                 | 
                <a href="services/disconnectService.php" title="Disconnect">Se déconnecter</a></div>
            <?php } else { ?>
                <div class="header">Espace membres</div>
                <?php
                    if (isset($_GET['etat'])) {
                        switch($_GET['etat']) {
                            case "error":
                                echo 'Mauvais nom de compte ou mot de passe';
                            break;
                        }
                    }
                ?>
                <form action="services/loginService.php" method="post">
                    <label>Nom de compte</label>
                    <input type="text" name="account" /><br/>

                    <label>Mot de passe</label>
                    <input type="password" name="password" /><br/>

                    <input type="submit" value="Envoyer" />
                </form>
                <a href="index.php?page=register">Inscription</a>
            <?php } ?>
        </div>

        <!-- Other 
        <div class="container green">
            <h1>Mon forum</h1>
        </div>
        -->

        <!-- Forum container -->
        <div class="container">
            <?= $dones ?>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>