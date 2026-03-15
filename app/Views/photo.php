<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="mb-3">
    <a href="<?= base_url('photos/' . $article->id) ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Photos
    </a>
    <a href="<?= base_url('article/' . $article->id) ?>" class="btn btn-secondary">
        <i class="bi bi-file-text"></i> View Article
    </a>
</div>
<h2><?= $article->title ?></h2>
<div class="text-center">
    <img src="<?= base_url('photos/' . $photo->path) ?>" alt="<?= $article->title ?>" class="img-fluid rounded shadow" style="max-height: 80vh;">
</div>
<?= $this->endSection() ?>
