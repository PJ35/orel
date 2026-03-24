<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h2>Upload File</h2>
<?php foreach ($errors as $error): ?>
    <li><?= $error ?></li>
<?php endforeach ?>
<form action="<?= base_url('photo/store') ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="userfile" size="20">
    <br><br>
    <input type="submit" value="upload">
</form>

<?= $this->endSection() ?>