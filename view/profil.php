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
        <?php if(isset($user)) { ?>
            <div class="container red">
                <div class="header">Profil de <?= $user['username'] ?></div>
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