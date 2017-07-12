<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include 'inc/header.php'; ?>
    <title>Sujet</title>
    <script type="text/javascript">
        tinymce.init({
        selector: '#reponse_sujet',
        width: "75%",
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

            <?= $data ?>
            <?= $data_response ?>

            <?php if (isset($_SESSION['user'])) { ?>
                <form action="services/postMessage.php" id="responseForm" method="post">

                    <input type="hidden" value="<?= $_SESSION['user']['id'] ?>" name="user_id"/>
                    <input type="hidden" value="<?= $_SESSION['user']['username'] ?>" name="user_name"/>
                    <input type="hidden" value="<?= $_GET['id'] ?>" name="sujet_id"/>

                    <div class="form_input">
                        <textarea id="reponse_sujet" name="contenue" ></textarea>
                        <div class="formRight_input">
                            <label>Tags</label><br/>
                            <input type="text" name="tags" class="tags" /><br/>
                            <input type="submit" class="button" value="poster" />
                        </div>
                    </div>
                    
                </form>
            <?php } else { ?>

                <p>Veillez vous connecter pour répondre au sujet</p>

            <?php  } ?>
        </div>
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>