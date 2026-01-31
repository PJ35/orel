<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1><?= $article->title ?></h1>
<div>
    <?= $article->text ?>
</div>
<a href="<?= base_url('article/edit/' . $article->id) ?>">Edit</a>
<?= $this->endSection() ?>