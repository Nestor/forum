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

                                <?php if($_GET['id'] == $_SESSION['user']['id']){ ?>
                                    <form action="services/email_changer.php" method="post">
                                        Changer d'adresse mail:
                                        <input type="hidden" name="id_user" value="<?=$_SESSION['user']['id']?>" />
                                        <input type="text" value="<?=$utilisateur[0]['email']?>" name="email" /><br/>
                                        <input type="submit" value="Changer d'adresse" name="submit">
                                    </form>

                                    <form action="services/password_changer.php" method="post">
                                        <input type="hidden" name="id_user" value="<?=$_SESSION['user']['id']?>" />
                                        Changer de mot de passe:
                                        <input type="password" name="ancienPassword" placeholder="Ancien mot de passe"/><br/>
                                        Nouveau mot de passe:
                                        <input type="password" name="password" placeholder="Nouveau mot de passe"/><br/>
                                        Confirmer le nouveau mot de passe:
                                        <input type="password" name="confirmPassword" placeholder="Confirmer le mot de passe"/><br/><br/>
                                        <input type="submit" value="Changer le mot de passe" name="submit">
                                    </form>

                                    <form action="services/avatar_changer.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_user" value="<?=$_SESSION['user']['id']?>" />
                                        Changer d'avatar
                                        <input type="file" name="uploadedfile" id="uploadedfile">
                                        <input type="submit" value="Uploader l'image" name="submit">
                                    </form>
                                <?php } ?>
                                
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