<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Sujet</title>
    <script type="text/javascript">
        tinymce.init({
        selector: '#reponse_sujet',
        width: "100%",
        height: "200px",
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
        });
    </script>
</head>
<body>
    <?php include 'inc/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'inc/main.php'; ?>

        <!-- Forum container -->
        <div class="container">
            <?php if (isset($_SESSION['user'])) { ?>
                <form action="services/postSujet.php" method="post">
                    <input type="hidden" name="idSCategorie" value="<?= $categorie_id ?>"/>
                    <input type="hidden" name="userID" value="<?= $_SESSION['user']['id'] ?>"/>
                    <input type="hidden" name="username" value="<?= $_SESSION['user']['username'] ?>"/>
                    <input type="text" name="titre" placeholder="Titre du sujet"/>
                    <textarea id="reponse_sujet" name="contenue" ></textarea>
                    <input type="submit" value="poster" />
                </form>
            <?php } else { ?>
                Veillez vous connecter pour répondre au sujet
            <?php  } ?>

            
        </div>
        
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>