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
    <div class="container-parent">

        <!-- Espace membres -->
        <div class="container red">
            <div class="header">Espace membres</div>
            <form action="<!-- Service -->" method="post">
                <label>Nom de compte</label>
                <input type="text" name="account" /><br/>

                <label>Mot de passe</label>
                <input type="password" name="password" /><br/>

                <input type="submit" value="Envoyer" />
            </form> 
        </div>

        <!-- Other 
        <div class="container green">
            <h1>Mon forum</h1>
        </div>
        -->

        <!-- Forum container -->
        <div class="container">
            <?php
                $object = $connexion->prepare('SELECT * FROM categories');
                $object->execute();
                $Categories = $object->fetchAll(PDO::FETCH_ASSOC);
                foreach($Categories as $categorie) {
                    $object_cat = $connexion->prepare('SELECT * FROM sous_categories WHERE id_categories=:id_cat');
                    $object_cat->execute(array(
                        "id_cat" => $Categories['id']
                    ));
                    $sous_Categories = $object_cat->fetchAll(PDO::FETCH_ASSOC);
                    var_dump($sous_Categories);
                    echo '
                    <div class="categorie">
                        <div class="header red"><p>'.$categorie['categorie'].'</p></div>
                        
                    </div>
                    ';
                }
            ?>
        </div>
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>