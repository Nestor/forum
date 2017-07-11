<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Liste des Membres</title>
</head>
<body>

    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>

        <!-- Forum container -->
        <div class="container">
            <div class="utilisateur">
                <?= $users?>
            </div>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>