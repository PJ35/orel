<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Fotogalerie</h1>
<p class="lead">Prohlédněte si fotky z našich článků - klikněte na libovolnou fotku a uvidíte všechny fotky z daného článku</p>
<?php if (!empty($photos)): ?>
    <div class="row">
        <?php foreach ($photos as $photo): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <a href="<?= base_url('photos/' . $photo->article_id) ?>" class="text-decoration-none">
                        <img src="<?= base_url('photos/' . $photo->path) ?>" alt="<?= isset($photo->article) ? $photo->article->title : 'Fotka' ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <?php if (isset($photo->article)): ?>
                                <h6 class="card-title text-dark"><?= $photo->article->title ?></h6>
                                <p class="card-text text-muted small">Zobrazit všechny fotky</p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        <p>V galerii zatím nejsou žádné fotky.</p>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>
