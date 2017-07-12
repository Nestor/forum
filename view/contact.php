<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Nous contacter</title>
</head>
<body>

    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>

        <!-- Forum container -->
        <div class="container">
            /!\ EN COURS DE DEV /!\
            <h2>Contact</h2>
            
            <?php if (isset($_SESSION['user'])) { ?>
                <form action="" method="post">
                    <input type="text" name="email" placeholder="Email"/><br/>
                    <input type="text" name="titre" placeholder="Titre"/><br/>
                    <textarea style="margin: auto;width: 99%;height:200px;" placeholder="Votre message"></textarea>
                    <input type="submit" value="Envoyer"/>
                </form>
            <?php } else { ?>
                <p>Veuillez vous connecter</p>
            <?php } ?>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>