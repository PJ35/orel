<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Lorem ipsum</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab molestiae nisi, sapiente, pariatur fugiat provident eius ipsa doloribus voluptatum tempora reiciendis delectus quam sequi saepe praesentium hic esse iusto sunt?</p>
<?php if (! empty($photos) && is_array($photos)): ?>
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <?php foreach ($photos as $index => $photo): ?>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="<?= $index ?>"<?php if ($index === 0) echo ' class="active"'; ?>></button>
            <?php endforeach; ?>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <?php foreach ($photos as $index => $photo): ?>
                <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
                    <img src="<?= base_url('photos/' . $photo->path) ?>" class="d-block w-100" alt="Image <?= $index + 1 ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>