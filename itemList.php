<?php
    if (!defined('READFILE')) {
        exit ("Неправильный путь к файлу! Вернитесь на<a href=\"index.php\">главную</a>.");
    }

    $id = (int) $_GET['cat_id'];
    $countAll = abs((int) $_GET['count']);
    $page = (int) $_GET['page'];
    $count = 12;
    $countPages = ceil($countAll / $count);
    $offset = $page * $count;
    $sql = "SELECT c.name, c.description
                FROM category as c
                    WHERE c.category_id = $id";
    $query = $db->prepare($sql);
    $query->execute();
    $about = $query->fetch();
    
    if (empty($about))
        header("Location: 404.php");
    
    $sql = "SELECT p.product_id, p.name, c.name AS category, i.url, i.alt
                FROM product p
                    JOIN product_category pc ON pc.product_id = p.product_id
                    JOIN category c ON c.category_id = p.main_category
                    JOIN image i ON i.image_id = p.main_image
                        WHERE pc.category_id = $id AND p.is_active = 1
                            ORDER BY p.name
                                LIMIT $count OFFSET $offset";

    $query = $db->prepare($sql);
    $query->execute();
    $list = $query->fetchAll();

    if (empty($list))
        header("Location: 404.php");

    $title = "Список товаров категории {$about['name']}";
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Все товары из категории <?=$about['name']?></title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/itemList.css">
</head>
<body>
    <div class="layout">
        <?php include "header.php"?>
        <div class="category__about">
            <div class="category__title"><?=$about['name']?></div>
            <div class="category__description"><?=$about['description']?></div>
        </div>
        <div class="item__list">
            <?php foreach ($list as $item): ?>
                <a href="index.php?id=<?=$item['product_id']?>">
                    <div class="card">
                        <div class="card__top card__image" style="background-image: url(<?=$item['url']?>)"></div>
                        <div class="card__bottom">
                            <?=$item['category']?></br>
                            <div class="card__bottom-title"><?=$item['name']?></div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
            <div class="list__break"></div>
            <div class="list__pages">
            <?php
                for ($i = 0; $i < $countPages; $i++) {
                    echo "<a href=\"index.php?cat_id=$id&count=$countAll&page=$i\"";
                    if ($page == $i)
                        echo "class=\"list__pages--underline\"";
                    echo ">";
                    echo $i + 1;
                    echo "</a>";
                }
            ?>
            </div>
        </div>
    </div>
</body>