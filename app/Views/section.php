<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1><?= $section->name ?></h1>
<p><?= $section->description ?></p>
<a href="<?= base_url('/section/edit/' . $section->id) ?>" class="btn btn-secondary">Upravit oddíl</a>
<?= $this->endSection() ?>