<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceuil</title>
    <script type="text/javascript" src="scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="scripts/tinymce/tinymce.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="styles/css/style.css" />
    <script type="text/javascript">
    tinymce.init({
    selector: '#reponse_sujet',
    width: "100%",
    height: "200px",
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
    ],
    toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css']
    });
    </script>
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

        <!-- Forum container -->
        <div class="container">
            <div class="sujet">
                <?= $data ?>
            </div>
            <form action="#" method="post">
            <textarea id="reponse_sujet"></textarea>
            <input type="submit" value="poster" />
            </form>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>