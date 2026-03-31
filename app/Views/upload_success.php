<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h3>Fotka byla úspěšně nahrána.</h3>

<ul>
    <li>název: <?= esc($uploaded_fileinfo->getBasename()) ?></li>
    <li>velikost: <?= esc($uploaded_fileinfo->getSizeByUnit('kb')) ?> KB</li>
    <li>přípona: <?= esc($uploaded_fileinfo->guessExtension()) ?></li>
</ul>

<p><?= anchor('photo/upload', 'Nahrát další fotku') ?></p>

<?= $this->endSection() ?>