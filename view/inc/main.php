<?php if (isset($_SESSION['user'])) { ?>
<div class="main-menu">
    <ul>
        <li><a href="index.php?page=accueil">Accueil</a></li>
        <li><a href="index.php?page=users_list">Membres</a></li>
        <li><a href="index.php?page=search">Recherche</a></li>
        <li><a href="index.php?page=profil&id=<?=$_SESSION['user']['id']?>">Profil</a></li>
        <li><a href="index.php?page=contact">Contact</a></li>
    </ul>
</div>
<?php } else { ?>
<div class="main-menu">
    <ul>
        <li><a href="index.php?page=accueil">Accueil</a></li>
        <li><a href="index.php?page=users_list">Membres</a></li>
        <li><a href="index.php?page=search">Recherche</a></li>
        <li><a href="index.php?page=space_member">Espace membre</a></li>
        <li><a href="index.php?page=contact">Contact</a></li>
    </ul>
</div>
<?php } ?>