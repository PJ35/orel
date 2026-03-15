<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="mb-3">
    <a href="<?= base_url('gallery') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Gallery
    </a>
    <a href="<?= base_url('article/' . $article->id) ?>" class="btn btn-secondary">
        <i class="bi bi-file-text"></i> View Article
    </a>
</div>
<h1>Photos: <?= $article->title ?></h1>
<?php if (!empty($photos)): ?>
    <div class="row">
        <?php foreach ($photos as $photo): ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <a href="<?= base_url('photo/' . $photo->id) ?>">
                        <img src="<?= base_url('photos/' . $photo->path) ?>" alt="<?= $article->title ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        <p>No photos available for this article.</p>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
