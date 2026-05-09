<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Upravit kontakt</h1>
<form action="<?= base_url('contact/update/' . $contact->id) ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Název</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $contact->name ?>" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Adresa</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= $contact->address ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Uložit</button>
</form>
<?= $this->endSection() ?>