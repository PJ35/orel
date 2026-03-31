<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<h1>Upravit oddíl</h1>
<form action="<?= base_url('/section/update/' . $section->id) ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Název oddílu</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $section->name ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Popis</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= $section->description ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Aktualizovat</button>
</form>
<?= $this->endSection() ?>