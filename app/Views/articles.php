<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Articles</h1>
<?php if (! empty($articles) && is_array($articles)): ?>
    <ul class="list-group">
        <?php foreach ($articles as $article): ?>
            <li class="list-group-item">
                <h5><a href="article/<?= $article->id ?>"><?= $article->title ?></a></h5>
                <p><?= substr(strip_tags($article->text), 0, 100) ?>...</p>
            </li>
        <?php endforeach; ?>
    </ul>
    <?= $pager->links() ?>
<?php else: ?>
    <p>No articles found.</p>
<?php endif; ?>
<?= $this->endSection() ?>