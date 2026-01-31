<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->include('layout/assets') ?>
    </head>
    <body>
        <?= $this->include('layout/navbar') ?>
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </body>
</html>