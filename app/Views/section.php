<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1><?= $section->name ?></h1>
<p><?= $section->description ?></p>
<?= $this->endSection() ?>