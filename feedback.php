<?php

    $userName = "";
    $email = "";
    $birthYear = "";
    $gender = "";
    $theme = "";
    $question = "";

    if (!empty($_COOKIE)) {
        $userName = htmlspecialchars(trim($_COOKIE["userName"]));
        $email = htmlspecialchars(trim($_COOKIE["email"]));
        $birthYear = (int) $_COOKIE["birthYear"];
        $gender = htmlspecialchars(trim($_COOKIE["gender"]));
    }
    
    //css classes with --red
    $nameColor = "";
    $emailColor = "";
    
    $notice = "";
    $wrongChars = '!?,/\|[]{}\'"()&*^%$#№;:~`<>+=';

    $title = "Обратная связь";

    if (!empty($_POST)) {
        $userName = htmlspecialchars(trim($_POST['userName']));
        $email = htmlspecialchars(trim($_POST['email']));
        $birthYear = (int) $_POST['birthYear'];
        $gender = $_POST['gender'];
        $theme = htmlspecialchars(trim($_POST['theme']));
        $question = htmlspecialchars(trim($_POST['question']));

        if (strpbrk($userName, $wrongChars)) {
            $notice .= "Ошибка в поле \"Имя\": использованы недопустимые символы ({$wrongChars}).<br>";
            $nameColor = "feedback__input-text--red";
        }
        if (strlen($userName) > 30) {
            $notice .= "Ошибка в поле \"Имя\": превышена максимальная длина строки.<br>";
            $nameColor = "feedback__input-text--red";
        }
        if (strpbrk($email, $wrongChars)) {
            $notice .= "Ошибка в поле \"Электронная почта\": использованы недопустимые символы ({$wrongChars}).<br>";
            $emailColor = "feedback__input-text--red";
        }
        print_r($_POST);
        echo "<br>";
        print_r($_COOKIE);
        if ($notice == "") {
            echo "2sd";
            $db = new PDO('mysql:host=localhost;dbname=bootcamp_sivirilova','root','');
            $db->exec("SET NAMES UTF-8");
            $sql = "INSERT INTO feedback (name, email, birth_year, gender, theme, question) VALUES (?, ?, ?, ?, ?, ?)";
            $param = [$userName, $email, $birthYear, $gender, $theme, $question];
            $query = $db->prepare($sql);
            $query->execute($param);

            setcookie("userName", $userName, time() + 24 * 3600);
            setcookie("email", $email, time() + 24 * 3600);
            setcookie("birthYear", $birthYear, time() + 24 * 3600);
            setcookie("gender", $gender, time() + 24 * 3600);

            $notice = "Ваш вопрос успешно задан!";
        }
    }
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/feedback.css">
    <title>Ответим на все ваши вопросы!</title>
</head>
<body>
    <div class="layout">
        <?php include "header.php"?>
        <div class="notice"><?=$notice?></div>
        <form class="feedback" name="feedback" method="post">
            <label class="feedback__title">Имя:</label><br>
            <input class="feedback__input-text <?=$nameColor?>" type="text" name="userName" value="<?=$userName?>" required>
            <br><br>
            <label class="feedback__title">Электронная почта:</label><br>
            <input class="feedback__input-text <?=$emailColor?>" type="email" name="email" value="<?=$email?>" required>
            <br><br>
            <label class="feedback__title">Год рождения</label><br>
            <select class="feedback__select" size="1" name="birthYear">
                <?php
                    for($i = date("Y"); $i > date("Y") - 100; $i--) {
                        if ($i == $birthYear)
                            echo "<option value=$i selected>$i</option>";
                        else
                            echo "<option value=$i>$i</option>";
                    }
                ?>
            </select>
            <br><br>
            <label class="feedback__title">Пол:</label><br>
            <div class="feedback__radios">
                <div>
                    <input type="radio" name="gender" value="М" id="male" required <?php if ($gender == "М") echo "checked"?>>
                    <label for="male" class="feedback__radio">Мужской</label>
                </div>
                <div>
                    <input type="radio"  name="gender" value="Ж" id="female" required <?php if ($gender == "Ж") echo "checked"?>>
                    <label for="female" class="feedback__radio">Женский</label>
                </div>
                <div>
                    <input type="radio"  name="gender" value="Д" id="other" required <?php if ($gender == "Д") echo "checked"?>>
                    <label for="other" class="feedback__radio">Другой</label>
                </div>
            </div>
            <br>
            <label class="feedback__title">Тема обращения:</label><br>
            <input class="feedback__input-text" type="text" name="theme" value="<?=$theme?>" required>
            <br><br>
            <label class="feedback__title">Суть вопроса:</label><br>
            <textarea name="question" required><?=$question?></textarea>
            <br>
            <input type="checkbox" name="checkRule" id="checkRule" required>
            <label for="checkRule">С контрактом ознакомлен</label>
            <br><br>
            <input class="feedback__submit" type="submit" value="Отправить">
        </form>
    </div>
</body>