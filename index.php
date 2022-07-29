<?php
    define('READFILE', true);
    header("Cache-Control: no-cache, must-revalidate");
    header("Cache-Control: post-check=0,pre-check=0", false);
    header("Cache-Control: max-age=0", false);
    header("Pragma: no-cache");

    $db = new PDO('mysql:host=localhost;dbname=bootcamp_sivirilova','root','');
    $db->exec("SET NAMES UTF-8");

    if (!empty($_GET)) {
        if (isset($_GET['cat_id']) and isset($_GET['count']) and isset($_GET['page']))
            include 'itemList.php';
        elseif (isset($_GET['id']))
            include 'item.php';
        else {
            header("Location: 404.php");
            exit;
        }
    }
    else {
        include 'categoryList.php';
    }
?>
