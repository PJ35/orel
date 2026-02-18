<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Sections</h1>
<ul class="list-group">
    <?php foreach ($sections as $section): ?>
        <li class="list-group-item">
            <h5><a href="<?= base_url('section/' . $section->id) ?>"><?= $section->name ?></a></h5>
        </li>
    <?php endforeach; ?>
</ul>
<?= $this->endSection() ?>