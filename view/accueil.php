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

        <!-- Forum container -->
        <div class="container">
            <?= $dones ?>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>