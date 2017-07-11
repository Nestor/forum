<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Sujet</title>
</head>
<body>
    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>

        <!-- Forum container -->
        <div class="container">
            <div class="categorie_sujet">
                <a href="index.php?page=create_sujet&category=<?=$_GET['category']?>" class="button">Créer un sujet</a><br/>
                <?php
                if(empty($data)) {
                    echo 'Aucun sujet disponible';
                }
                ?>
                <?= $data ?>
            </div>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>