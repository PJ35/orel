<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h2>Upload File</h2>

<?php foreach ($errors as $error): ?>
    <li><?= esc($error) ?></li>
<?php endforeach ?>

<?= form_open_multipart('upload/upload') ?>
    <input type="file" name="userfile" size="20">
    <br><br>
    <input type="submit" value="upload">
</form>

<?= $this->endSection() ?>