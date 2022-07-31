<?php
    $path = "";
    if (strpbrk($_SERVER['REQUEST_URI'], '?f')) {
        $display = "block";
        if (!strpbrk($_SERVER['REQUEST_URI'], '_'))
            $path = strstr($_SERVER['HTTP_REFERER'], "?");
    }
?>

<header>
    <a class="header__back-btn" href="index.php<?=$path?>" style="display: <?=$display?>"></a>
    <a class="header__feedback" href="feedback.php"></a>
    <div class="header__title"><?=$title?></div>
</header>