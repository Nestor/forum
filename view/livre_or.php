<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>
</head>
<body>
    <h1>Livrer d'or</h1>
    <form action="services/formService.php" method="post">

        <input type="text" name="msg"/>

        <input type="submit" value="Envoyer"/>

    </form>
    <h2>Utilisateur en ligne</h2>
    <?php
    if ( isset($_GET['msg']) && isset($_GET['callback'])) {
        echo $_GET['msg'];
    }
    ?>
    <?= $userMsg.' Users en ligne.' ?>
</body>
</html>