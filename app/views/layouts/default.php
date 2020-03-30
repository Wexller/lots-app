<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="/public/scripts/form.js"></script>
    <script src="/public/scripts/inputs.js"></script>
    <link rel="stylesheet" href="/public/styles/styles.css">
    <title><?= $title ?></title>
</head>
<body>
    <header>
    </header>
    <nav class="navigation">
        <div class="container">
            <ul class="navigation__list">
                <li class="navigation__item">
                    <a href="/" class="navigation__link<?= $_SERVER['REQUEST_URI'] === '/'
                      ? ' active' : '' ?>">Все лоты</a>
                </li>
                <li class="navigation__item">
                    <a href="/lots" class="navigation__link<?= $_SERVER['REQUEST_URI'] === '/lots'
                      ? ' active' : '' ?>">Выстановленные лоты</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h1><?= $title ?></h1>
<!--            <div class="title"></div>-->
        <?= $content ?>
    </div>

    <footer>

    </footer>
</body>
</html>