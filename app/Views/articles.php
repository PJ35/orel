<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<h1>Články</h1>
<?php if (! empty($articles) && is_array($articles)): ?>
    <ul class="list-group">
        <?php foreach ($articles as $article): ?>
            <li class="list-group-item">
                <div class="row">
                    <?php if (isset($article->featured_photo) && $article->featured_photo): ?>
                        <div class="col-md-3">
                            <a href="photos/<?= $article->id ?>">
                                <img src="<?= base_url('photos/' . $article->featured_photo->path) ?>" alt="<?= $article->title ?>" class="img-fluid rounded">
                            </a>
                        </div>
                        <div class="col-md-9">
                    <?php else: ?>
                        <div class="col-md-12">
                    <?php endif; ?>
                            <h5><a href="article/<?= $article->id ?>"><?= $article->title ?></a></h5>
                            <p><?= substr(strip_tags($article->text), 0, 100) ?>...</p>
                            <?php if (session()->has('identity') && service('ion_auth')->isAdmin()): ?>
                                <a href="<?= base_url('article/edit/' . $article->id) ?>" class="btn btn-sm btn-primary">Upravit</a>
                            <?php endif; ?>
                        </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?= $pager->links() ?>
<?php else: ?>
    <p>Žádné články nebyly nalezeny.</p>
<?php endif; ?>
<?= $this->endSection() ?>