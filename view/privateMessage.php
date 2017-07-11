<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/header.php'; ?>
    <title>Boite de réception</title>
    <script type="text/javascript">
        tinymce.init({
        selector: '#pvMSG',
        width: "80%",
        height: "300px",
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
        <!-- Espace membres -->
        <?php if(isset($_SESSION['user'])) { ?>
            <div class="container red">
                <div class="header green">Boite de reception de <?= $utilisateur[0]['username'] ?><a href="index.php"> <-|</a></div>
                <table style="border: 1px solid black;">
                    <tr>
                        <th>Message</th>
                        <th>Reçu le</th>
                        <th>par</th>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>Reçu le</td>
                        <td>par</td>
                    </tr>
                </table>
                <form action="#" method="post">

                    <label>Utilisateur</label><br/>
                    <input type="text" name="user" /><br/><br/>

                    <label>Titre</label><br/>
                    <input type="text" name="title" /><br/><br/>

                    <label>Message</label><br/>
                    <textarea id="pvMSG" name="message"></textarea><br/><br/>

                    <input type="submit" value="Envoyer" />
                </form>
            </div>
        <?php } else { ?>
            <div class="container red">
                <div class="header">Erreur connexion</div>
                <h2>Veuillez vous connecter</h2>
            </div>
        <?php } ?>
    </div>
    <script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>