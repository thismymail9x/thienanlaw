<nav aria-label="...">
    <ul class="pagination">
        <?php $pageCount = $pager->getPageCount(); ?>
        <?php $currentPage = $pager->getCurrentPageNumber(); ?>
        <?php if ($pager->hasPreviousPage()) { ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>">
                    Đầu
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>">
                    Trước
                </a>
            </li>
        <?php } ?>
        <?php if($pageCount <= 8) { ?>
            <?php foreach ($pager->links() as $link) { ?>
                <?php if ($link['active'] == true) { ?>
                    <li class="page-item active">
                        <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <?php $pageLinks = $pager->links(); ?>
            <?php if($currentPage <= 4) { ?>
                <?php for($i = 0; $i <= $currentPage + 1; $i ++) { ?>
                    <?php if ($pageLinks[$i]['active'] == true) { ?>
                        <li class="page-item active">
                            <a class="page-link" href="<?= $pageLinks[$i]['uri'] ?>"><?= $pageLinks[$i]['title'] ?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $pageLinks[$i]['uri'] ?>"><?= $pageLinks[$i]['title'] ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
                <li class="page-item" style="padding: 0 10px;"> ... </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pageLinks[$pageCount - 1]['uri'] ?>"><?= $pageCount ?>
                    </a>
                </li>
            <?php } else if($currentPage >= $pageCount - 3) { ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pageLinks[0]['uri'] ?>"><?= 1 ?>
                    </a>
                </li>
                <li class="page-item" style="padding: 0 10px;"> ... </li>
                <?php for($i = $currentPage - 3; $i <= $pageCount - 1; $i ++) { ?>
                    <?php if ($pageLinks[$i]['active'] == true) { ?>
                        <li class="page-item active">
                            <a class="page-link" href="<?= $pageLinks[$i]['uri'] ?>"><?= $pageLinks[$i]['title'] ?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $pageLinks[$i]['uri'] ?>"><?= $pageLinks[$i]['title'] ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pageLinks[0]['uri'] ?>"><?= 1 ?>
                    </a>
                </li>
                <li class="page-item" style="padding: 0 10px;"> ... </li>
                <?php for($i = $currentPage - 3; $i <= $currentPage + 1; $i ++) { ?>
                    <?php if ($pageLinks[$i]['active'] == true) { ?>
                        <li class="page-item active">
                            <a class="page-link" href="<?= $pageLinks[$i]['uri'] ?>"><?= $pageLinks[$i]['title'] ?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $pageLinks[$i]['uri'] ?>"><?= $pageLinks[$i]['title'] ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
                <li class="page-item" style="padding: 0 10px;"> ... </li>
                <li class="page-item">
                    <a class="page-link" href="<?= $pageLinks[$pageCount - 1]['uri'] ?>"><?= $pageCount ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>
        <?php if ($pager->hasNextPage()) { ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>">
                    Tiếp
                </a>
            </li>
            <li>
                <a class="page-link" href="<?= $pager->getLast() ?>">
                    Cuối
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>