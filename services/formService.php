<?php
/**
 * Alfonso: Pourquoi on inclus ici un des fonction d'un autre projet?
 */

include "../20_mvc/model/fonction.php";

if (isset($_POST['msg'])) {
    setMsg($_POST['msg']);
    header('../20_mvc/index.php?page=livre_dor&msg='.$_POST['msg'].'&callback=success');
}
?>