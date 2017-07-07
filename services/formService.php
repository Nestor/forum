<?php
try {

} catch (Exception $e) {
    echo $e->getMessage();
}
include "../20_mvc/model/fonction.php";

if (isset($_POST['msg'])) {
    setMsg($_POST['msg']);
    header('../20_mvc/index.php?page=livre_dor&msg='.$_POST['msg'].'&callback=success');
}
?>