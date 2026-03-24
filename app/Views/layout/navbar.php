<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/') ?>">Orel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('gallery') ?>">Photos</a>
                </li>
                <?php if (session()->has('identity') && service('ion_auth')->isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('photo/upload') ?>">Upload</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('articles') ?>">Articles</a>
                </li>
                <?php if (session()->has('identity') && service('ion_auth')->isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('article/create') ?>">Create Article</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('sections') ?>">Sections</a>
                </li>
                <?php if (session()->has('identity') && service('ion_auth')->isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('section/create') ?>">Create Section</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (session()->has('identity')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= session()->get('identity') ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a></li>
                            <?php if (service('ion_auth')->isAdmin()): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url('auth') ?>">Users</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('auth/create_user') ?>">Create User</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/login') ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>