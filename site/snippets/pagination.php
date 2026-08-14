<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Pagination $pagination
 */
?>
<?php if ($pagination->hasPages()): ?>
<nav class="pagination">
  <?php if ($pagination->hasPrevPage()): ?>
  <a class="pagination-prev" aria-label="<?= t('base.pagination.prev') ?>" href="<?= $pagination->prevPageUrl() ?>">&larr;</a>
  <?php else: ?>
  <span class="pagination-prev">&larr;</span>
  <?php endif ?>
  <?php if ($pagination->hasNextPage()): ?>
  <a class="pagination-next" aria-label="<?= t('base.pagination.next') ?>" href="<?= $pagination->nextPageUrl() ?>">&rarr;</a>
  <?php else: ?>
  <span class="pagination-next">&rarr;</span>
  <?php endif ?>
</nav>
<?php endif ?>
