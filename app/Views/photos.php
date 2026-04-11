<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="mb-3">
    <a href="<?= base_url('gallery') ?>" class="btn btn-secondary">Zpět do galerie</a>
    <a href="<?= base_url('article/' . $article->id) ?>" class="btn btn-secondary">Zobrazit článek</a>
</div>
<h1>Fotky: <?= $article->title ?></h1>
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
        <p>Pro tento článek nejsou dostupné žádné fotky.</p>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
