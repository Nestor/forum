<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Inscription</title>
</head>
<body>
    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>
        <!-- Espace membres -->
        <div class="container red">
            <div class="header green">Inscription <a href="index.php"><-|</a></div>
            <?php
            if (isset($_GET['etat'])) {
                switch($_GET['etat']) {
                    case 'success':
                        echo 'Vous êtes maintenant inscript';
                    break;
                    case 'error':
                        echo 'Veuillez remplir tout les champs !';
                    break;
                    case 'exist':
                        echo 'Ce compte existe déjà';
                    break;
                }
            }
            ?>
            <form action="services/registerService.php" method="post">
            <label>Nom de compte</label>
            <input type="" name="account"/><br/>
            <label>Mot de passe</label>
            <input type="password" name="password"/><br/>
            <label>Adresse mail</label>
            <input type="text" name="email"/><br/>
            <input type="submit" value="S'inscrire" />
            </form>


        </div>
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>