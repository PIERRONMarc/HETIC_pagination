<?php

$pageCount = $total / $limit;
$currentPage = Utilities::getPageNumber();
$startPage = $currentPage < 2 ? 1 : $currentPage - 1;
$endPage = $currentPage == $pageCount ? $currentPage : $currentPage + 1;
$range = $endPage - $startPage;

?>
<nav>
    <ul class="pagination" style="margin-bottom: 0">
        <?php if($currentPage > 1) :?>
            <li class="page-item">
                <a class="page-link" rel="prev" href="?page=<?= $currentPage - 1 ?>&<?= Request::generateQueryParameters(['direction', 'field', 'limit'])?>">&laquo;&nbsp;Précédent</a>
            </li>
        <?php else :?>
            <li class="page-item disabled">
                <span class="page-link">&laquo;&nbsp;Précédent</span>
            </li>
        <?php endif; ?>


        <?php if($startPage > 1) :?>
            <li class="page-item">
                <a class="page-link" href="?page=1&<?= Request::generateQueryParameters(['direction', 'field', 'limit'])?>">1</a>
            </li>
            <?php if($startPage == 3) :?>
                <li class="page-item">
                    <a class="page-link" href="?page=2&<?= Request::generateQueryParameters(['direction', 'field', 'limit'])?>">2</a>
                </li>
            <?php elseif($startPage != 2) :?>
                <li class="page-item disabled">
                    <span class="page-link">&hellip;</span>
                </li>
            <?php endif; ?>
        <?php endif; ?>


        <?php for ($page=$startPage; $page <= $endPage ;$page++) :?>
            <?php if ($page != $currentPage) :?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page ?>&<?= Request::generateQueryParameters(['direction', 'field', 'limit'])?>"><?= $page ?></a>
                </li>
            <?php else :?>
                <li class="page-item active">
                    <span class="page-link"><?= $page ?></span>
                </li>
            <?php endif; ?>
        <?php endfor ?>


        <?php if($pageCount > $endPage) :?>
            <?php if($pageCount > ($endPage + 1)) :?>
                <?php if($pageCount > ($endPage + 2)) :?>
                    <li class="page-item disabled">
                        <span class="page-link">&hellip;</span>
                    </li>
                <?php else :?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $pageCount - 1 ?>&<?= Request::generateQueryParameters(['direction', 'field', 'limit'])?>"><?= $pageCount - 1 ?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?=$pageCount?>&<?= Request::generateQueryParameters(['direction', 'field', 'limit'])?>"><?= $pageCount ?></a>
            </li>
        <?php endif; ?>


        <?php if ($currentPage < $pageCount) :?>
            <a class="page-link" rel="next" href="?page=<?= Utilities::getPageNumber() + 1 ?>&<?= Request::generateQueryParameters(['direction', 'field', 'limit'])?>">Suivant&nbsp;&raquo;</a>
        <?php else :?>
            <li  class="page-item disabled">
                <span class="page-link">Suivant&nbsp;&raquo;</span>
            </li>
        <?php endif; ?>
    </ul>
</nav>