<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1><?= $article->title ?></h1>

<?php if (!empty($photos) && count($photos) > 0): ?>
    <div class="mb-3">
        <a href="<?= base_url('photos/' . $article->id) ?>" class="btn btn-primary">
            <i class="bi bi-images"></i> View Photos (<?= count($photos) ?>)
        </a>
    </div>
<?php endif; ?>

<div>
    <?= $article->text ?>
</div>
<a href="<?= base_url('article/edit/' . $article->id) ?>">Edit</a>
<?= $this->endSection() ?>