<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h3>Fotka byla úspěšně nahrána.</h3>

<ul>
    <li>název: <?= $uploaded_fileinfo->getBasename() ?></li>
    <li>velikost: <?= $uploaded_fileinfo->getSizeByUnit('kb') ?> KB</li>
    <li>přípona: <?= $uploaded_fileinfo->guessExtension() ?></li>
</ul>

<p><?= anchor('photo/upload', 'Nahrát další fotku', ['class' => 'btn btn-primary']) ?></p>

<?= $this->endSection() ?>