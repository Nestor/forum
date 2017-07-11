<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceuil</title>
    <script type="text/javascript" src="scripts/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="scripts/tinymce/tinymce.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="styles/css/style.css" />
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
    <?php include 'include/formCo.php'; ?>

    <div class="container-parent">

        <?php include 'include/main.php'; ?>

        <!-- Forum container -->
        <div class="container">
            <?= $data ?>
            <?php if (isset($_SESSION['user'])) { ?>
                <form action="services/postMessage.php" method="post">
                    <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="user_id"/>
                    <input type="hidden" value="<?= $_GET['id'] ?>" name="sujet_id"/>
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