<?php
    include('htmlClass.php');
    $page = new HTMLPage($_POST['lbl'],$_POST);
    $page->write();
?>