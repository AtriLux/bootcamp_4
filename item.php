<?php
    if (!defined('READFILE')) {
        exit ("Неправильный путь к файлу! Вернитесь на<a href=\"index.php\">главную</a>.");
    }

    $id = (int) ($_GET['id']);
    $sql = "SELECT p.name, p.description, p.price, p.price_sale, p.price_promocode
	            FROM product AS p
			        WHERE p.product_id = $id";
    $query = $db->prepare($sql);
    $query->execute();
    $about = $query->fetch();

    if (empty($about))
        header("Location: 404.php");

    $sql = "SELECT i.url, i.alt
                FROM image AS i
                    JOIN product_image AS pi ON i.image_id = pi.image_id
                        WHERE pi.product_id = $id";
    $query = $db->prepare($sql);
    $query->execute();
    $images = $query->fetchAll();

    $sql = "SELECT c.category_id AS id, c.name
                FROM category AS c
                    JOIN product_category AS pc ON c.category_id = pc.category_id
                        WHERE pc.product_id = $id";
    $query = $db->prepare($sql);
    $query->execute();
    $categories = $query->fetchAll();

    $title = "Товар {$about['name']}";
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Товар <?=$about['name']?> готов к покупке!</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/item.css">
    <script src="lib/jquery-3.6.0.js"></script>
    <script src="lib/notify.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="layout">
        <?php include "header.php"?>
        <div class="item">
            <div class="item__view">
                <div class="item__view-slider">
                    <?php foreach ($images as $image):?>
                        <img class="slider__pic" src=<?=$image['url']?> alt=<?=$image['alt']?>>
                    <?php endforeach ?>
                </div>
                <div class="item__view-main">
                    <img class="view-main__img">
                </div>
            </div>
            <div class="item__description">
                <h1 class="item__title"><?=$about['name']?></h1>
                <div class="item__nav">
                    <?php foreach ($categories as $category):?>
                        <div class="item__nav-list"><?=$category['name']?></div>
                    <?php endforeach ?>
                </div>
                <div class="item__cost">
                    <div class="item__cost-old">
                        <?php
                            if (is_null($about['price_sale']))
                                echo "{$about['price']} &#8399;";
                            else
                                echo "<del>{$about['price']}</del> {$about['price_sale']} &#8399;"
                        ?>
                    </div>
                    <div class="item__cost-new">
                        <?php
                            if (!is_null($about['price_promocode']))
                                echo "<span>{$about['price_promocode']} &#8399;</span> — с промокодом";
                        ?>
                    </div>
                </div>
                <div class="item__specific">
                    <div class="item__specific-li">
                        <img class="item__specific-img" src="img/service/item__specific-img-1.png">
                        В наличии в магазине <span>М.Бытие</span>
                    </div>
                    <div class="item__specific-li">
                        <img class="item__specific-img" src="img/service/item__specific-img-2.png">
                        Бесплатная доставка
                    </div>
                </div>
                <div class="item__counter">
                    <button class="counter__btn counter__btn-decrement" disabled>-</button>
                    <input class="counter__num" type="number" value="1">
                    <button class="counter__btn counter__btn-increment">+</button>
                </div>
                <div class="item__btns-container">
                    <button class="item__btn item__btn--blue">Купить</button>
                    <button class="item__btn">В избранное</button>
                </div>
                <div class="item__about">
                    <?=$about['description']?>
                </div>
                <div class="item__share">
                    Поделиться:
                    <a href="">
                        <img class="item__share-icon item__share-icon--first" src="img/service/item__share-icon-1.png"></img>
                    </a>
                    <a href="">
                        <img class="item__share-icon" src="img/service/item__share-icon-2.png"></img>
                    </a>
                    <a href="">
                        <img class="item__share-icon" src="img/service/item__share-icon-3.png"></img>
                    </a>
                    <a href="">
                        <img class="item__share-icon" src="img/service/item__share-icon-4.png"></img>
                    </a>
                    <div class="item__share-count"><?=rand(0,200)?></div>
                </div>
            </div>
        </div>
    </div>
</body>