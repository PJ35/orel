<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<h1>Kontaktujte nás</h1>
<?php if (! empty($contacts) && is_array($contacts)): ?>
    <ul class="list-group">
        <?php foreach ($contacts as $contact): ?>
            <li class="list-group-item">
                <h5><?= $contact->name ?></h5>
                <p>Adresa: <?= $contact->address ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div id="map" style="height: 400px;"></div>
<script>
    var map = L.map('map').setView([49.075756, 17.444586], 16);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
    var marker = L.marker([49.075756, 17.444586]).addTo(map)
        .bindPopup('Orel Staré Město')
        .openPopup();
</script>
<?= $this->endSection(); ?>