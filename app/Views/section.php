<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1><?= $section->name ?></h1>
<p><?= $section->description ?></p>
<?php if (session()->has('identity') && service('ion_auth')->isAdmin()): ?>
    <a href="<?= base_url('/section/edit/' . $section->id) ?>" class="btn btn-primary">Upravit oddíl</a>
<?php endif; ?>
<?= $this->endSection() ?>