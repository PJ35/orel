<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Vytvořit oddíl</h1>
<?php if (isset($validation) && $validation->getErrors()): ?>
    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
<?php endif; ?>
<form action="<?= base_url('/section/store') ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Název oddílu</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Popis</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">Vedoucí</label>
        <select class="form-select" id="user_id" name="user_id" required>
            <option value="">Vyberte uživatele</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id ?>">
                    <?= $user->email ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Vytvořit</button>
</form>
<?= $this->endSection() ?>