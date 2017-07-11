<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Rechercher</title>
</head>
<body>

    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>

        <!-- Forum container -->
        <div class="container">

            <h2>Rechercher un sujet</h2>
            <form action="" method="post">
                <input type="text" name="value"/><br/>
                <input type="submit" value="Rechercher"/>
            </form>
            <hr/>

            <h2>Rechercher un sujet dans une catégorie</h2>
            <form action="#" method="post">
                <input type="text" name="value"/>
                <select name="catagorie">
                    <option value="3">HTML</option>
                    <option value="4">CSS</option>
                    <option value="5">Javascript</option>
                    <option value="6">PHP</option>
                </select>
                <input type="submit" value="Rechercher"/>
            </form>
            <hr/>
            <h2>Rechercher un membre</h2>
            <form action="" method="post">
                <input type="text" name="value"/><br/>
                <input type="submit" value="Rechercher"/>
            </form>
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>