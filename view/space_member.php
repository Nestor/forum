<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Espace membre</title>
</head>
<body>

    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>

        <!-- Forum container -->
        <div class="container">
            <div id="Register_LoginPanel">
                <div class="login">
                <?php
                    if(isset($_GET['etat'])) {
                        switch($_GET['etat']) {
                            case "error":
                                echo 'Erreur nom de compte ou mot de passe';
                            break;
                            case "connect":
                                echo 'Vous êtes maintenant connecter';
                            break;
                            case "champempty":
                                echo 'Veuillez remplir tout les champs';
                            break;
                            case "disconnect":
                                echo 'Vous êtes maintenant déconnecter';
                            break;
                        }
                    }
                ?>
                    <h2>Connexion</h2>
                    <form action="services/loginService.php" method="post">
                        <input type="text" name="account" placeholder="Nom de compte" required>
                        <br>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                        <br>
                        <br>
                        <input type="submit" value="Se connecter">
                        <a href="index.php?page=retrievepassword">Mot de passe oublié ?</a>
                    </form>
                    
                </div>
                <div class="separator"></div>
                <div class="register">
                    <?php
                        if(isset($_GET['etat'])) {
                            switch($_GET['etat']) {
                                case "successins":
                                    echo 'Vous êtes maintenant inscript';
                                break;
                                case "errorins":
                                    echo 'Il y a une erreur vérifier tout les champs';
                                break;
                            }
                        }
                    ?>
                    <h2>Inscription</h2>
                    <form action="services/registerService.php" method="post">
                        <input type="text" name="account" placeholder="Nom de compte" required><br>
                        <input type="password" name="password" placeholder="Mot de passe" required><br>
                        <input type="password" name="passwordconfirm" placeholder="Confirmer mot de passe" required><br>
                        <input type="text" name="email" placeholder="Adresse mail" required><br>
                        <input type="text" name="question" placeholder="Question secrète"/><br/>
                        <input type="text" name="response" placeholder="Réponse secrète"/><br/><br/>
                        <input type="submit" value="S'inscrire">

                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>