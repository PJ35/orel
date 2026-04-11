<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Oddíly</h1>
<ul class="list-group">
    <?php foreach ($sections as $section): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><a href="<?= base_url('section/' . $section->id) ?>"><?= $section->name ?></a></h5>
            <?php if (session()->has('identity') && service('ion_auth')->isAdmin()): ?>
                <a href="<?= base_url('section/edit/' . $section->id) ?>" class="btn btn-sm btn-primary">Upravit</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<?= $this->endSection() ?>