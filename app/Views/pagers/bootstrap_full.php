<?php

use CodeIgniter\Pager\PagerRenderer;

$pageCount = $pager->getPageCount();
$currentPage = $pager->getCurrentPageNumber();

$surroundCount = 1;
if ($pageCount >= 3 && ($currentPage === 1 || $currentPage === $pageCount)) {
    $surroundCount = 2;
}

$pager->setSurroundCount($surroundCount);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center mt-4">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                    &laquo;
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    &lsaquo;
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">&laquo;</span>
            </li>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">&lsaquo;</span>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item<?= $link['active'] ? ' active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>"<?= $link['active'] ? ' aria-current="page"' : '' ?>>
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
                    &rsaquo;
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                    &raquo;
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">&rsaquo;</span>
            </li>
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">&raquo;</span>
            </li>
        <?php endif ?>
    </ul>
</nav>
