<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sujet</title>
    <script type="text/javascript" src="scripts/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="styles/css/style.css" />
</head>
<body>
    <?php include 'include/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'include/main.php'; ?>

        <!-- Forum container -->
        <div class="container">
            <div class="categorie">
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