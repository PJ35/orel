<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h2>Nahrát fotku</h2>
<?php foreach ($errors as $error): ?>
    <li><?= $error ?></li>
<?php endforeach ?>
<form action="<?= base_url('photo/store') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="article_id" class="form-label">Článek</label>
        <select id="article_id" name="article_id" class="form-select" required>
            <option value="">Vyberte článek</option>
            <?php foreach ($articles as $article): ?>
                <option value="<?= $article->id ?>"><?= $article->title ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
        <label class="form-check-label" for="featured">Zobrazit na hlavní stránce</label>
    </div>
    <div class="mb-3">
        <label for="userfile" class="form-label">Soubor</label>
        <input type="file" name="userfile" id="userfile" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Nahrát</button>
</form>

<?= $this->endSection() ?>