<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1><?= $article->title ?></h1>
<div>
    <?= $article->text ?>
</div>
<?= $this->endSection() ?>