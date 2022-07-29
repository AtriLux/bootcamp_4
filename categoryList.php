<?php
    if (!defined('READFILE')) {
        exit ("Неправильный путь к файлу! Вернитесь на<a href=\"index.php\">главную</a>.");
    }

    $sql = "SELECT c.category_id, c.name, count(pc.product_id) as count
                FROM category as c
                    JOIN product_category as pc ON c.category_id = pc.category_id
                    JOIN product as p ON p.product_id = pc.product_id
                        WHERE p.is_active = 1
                            GROUP BY c.category_id, c.name
                                ORDER BY count DESC";
    $query = $db->prepare($sql);
    $query->execute();
    $list = $query->fetchAll();

    $title = "Категории товаров";
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>М.Бытие — интернет-магазин всевозможной техники</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/categoryList.css">
</head>
<body>
    <div class="layout">
        <?php include "header.php"?>
        <div class="category__text">Выберите подходяющую категорию:</div>
        <div class="category__list">
<?php foreach ($list as $category): ?>
            <a href="index.php?cat_id=<?=$category['category_id']?>&count=<?=$category['count']?>&page=0">
                <div class="card">
                    <div class="card__title">
                        <?=$category['name']?>
                    </div>
                    <div class="card__count">
                        Товаров в категории: <?=$category['count']?>
                    </div>
                </div>
            </a>
<?php endforeach ?>
        </div>
    </div>
</body>