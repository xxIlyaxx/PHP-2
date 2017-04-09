<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Админ-панель</h1>
    <a href="/index">Главная страница</a>
    <br>
    <a href="/admin/add-article">Добавить статью</a>
    <hr>
    <?php foreach ($articles as $article): ?>
        <div>
            <h2><?php echo $article->title; ?></h2>
            <p><?php echo $article->lead; ?></p>
            <p><?php echo (null !== $article->author) ? 'Автор: ' . $article->author->name : 'Неизвестный автор'; ?></p>
            <a href="/admin/delete-article/?id=<?php echo $article->id; ?>" class="btn btn-danger">Удалить</a>
            <a href="/admin/update-article/?id=<?php echo $article->id; ?>" class="btn btn-primary">Редактировать</a>
            <hr>
        </div>
    <?php endforeach; ?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>