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
                    <h2>Mot de passe perdu</h2>
                    <?php
                            if(isset($_GET['password'])){
                                if($_GET['password'] == "error"){
                                    echo 'Il y a une erreur';
                                } else {
                                    echo 'Votre mot de passe est: '.$_GET['password'];
                                }
                            }
                        ?>
                    <form action="services/searchPassword.php" method="post">
                        
                        <label>Nom de compte</label>
                        <input type="text" name="account" /><br/>
                        <label>Question secrète</label>
                        <input type="text" name="question" /><br/>
                        <label>Réponse secrète</label>
                        <input type="text" name="response" /><br/><br/>
                        <input type="submit" value="Retrouver"/>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>