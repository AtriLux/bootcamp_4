<?php
    $path = "";
    if (strstr($_SERVER['REQUEST_URI'], "?")) {
        $display = "block";
        if (!strstr($_SERVER['REQUEST_URI'], "?cat_id"))
            $path = strstr($_SERVER['HTTP_REFERER'], "?cat_id");
    }
?>

<header>
    <a class="header__back-btn" href="index.php<?=$path?>" style="display: <?=$display?>"></a>
    <div class="header__title"><?=$title?></div>
</header>