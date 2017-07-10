<div id="login_panel">

    <?php if(isset($_SESSION['user'])){ ?>
        <h2>Bonjour <a href="index.php?page=profil&id=<?=$_SESSION['user']['id']?>" title="Profil page"><?= $_SESSION['user']['username'] ?></a>
        <br/><a href="index.php?page=mp&id=<?=$_SESSION['user']['id']?>" title="Message privée">Message privée (0)</a>
        <br/><a href="services/disconnectService.php">Se déconnecter</a>
        <?php
            if (isset($_GET['etat'])) {
                switch($_GET['etat']) {
                    case "error":
                        echo 'Mauvais nom de compte ou mot de passe';
                    break;
                }
            }
        ?>
    <?php } else { ?>
    <h2>Espace connexion</h2>
    <form action="services/loginService.php" method="post" id="formco">
        <input type="text" name="account" placeholder="Nom de compte" required/>
        <br/>
        <input type="password" name="password" placeholder="Mot de passe" required/>
        <br/>
        <br/>
        <input type="submit" value="Se connecter"/>
    </form>
    <?php } ?>
    <div class="btn_panel"><p>Ouvrir</p></div>
</div>