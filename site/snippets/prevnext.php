<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>
<nav class="blog-prevnext">
  <h2 class="h2"><?= t('base.keepReading') ?></h2>

  <div class="autogrid" style="--gutter: 1.5rem">
    <?php if ($prev = $page->prevListed()): ?>
    <?php snippet('post', ['post' => $prev, 'excerpt' => false])  ?>
    <?php endif ?>

    <?php if ($next = $page->nextListed()): ?>
    <?php snippet('post', ['post' => $next, 'excerpt' => false])  ?>
    <?php endif ?>
  </div>
</nav>
