<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>
  <div class="header flex justify-between flex-wrap gap-s items-center">

    <a class="no-underline font-bold" href="<?= $site->url() ?>">
      <?= $site->title()->esc() ?>
    </a>

    <nav class="flex gap-2xs">
      <?php foreach ($site->children()->listed() as $item): ?>
        <a class="no-underline" <?= $item->isOpen() ? 'aria-current="page"' : '' ?> href="<?= $item->url() ?>">
          <?= $item->title()->esc() ?>
        </a>
      <?php endforeach ?>
    </nav>

    <?php snippet('global/lang-switcher') ?>

    <?php snippet('global/theme-toggle') ?>


  </div>