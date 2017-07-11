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
    <?php include 'include/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'include/main.php'; ?>
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
            <input type="text" name="email"/><br/><br/>

            <input type="submit" value="S'inscrire" />
            </form>


        </div>
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>