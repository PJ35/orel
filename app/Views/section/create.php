<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Create Section</h1>
<form action="<?= base_url('/section/store') ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Section Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
<?= $this->endSection() ?>