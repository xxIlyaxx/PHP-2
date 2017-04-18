<h2><?php echo $article->title; ?></h2>
<p><?php echo $article->lead; ?></p>
<p><?php echo (null !== $article->author) ? 'Автор: ' . $article->author->name : 'Неизвестный автор'; ?></p>
