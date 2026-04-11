<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1><?= $article->title ?></h1>

<?php if (!empty($photos) && count($photos) > 0): ?>
    <div class="mb-3">
        <a href="<?= base_url('photos/' . $article->id) ?>" class="btn btn-primary">Zobrazit fotky (<?= count($photos) ?>)</a>
    </div>
<?php endif; ?>

<div>
    <?= $article->text ?>
</div>
<?php if (session()->has('identity') && service('ion_auth')->isAdmin()): ?>
    <div class="mt-3">
        <a href="<?= base_url('article/edit/' . $article->id) ?>" class="btn btn-primary">Upravit</a>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>