<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 * @var \PostPage $page PostPage adds cover(), published(), summary()
 */
?>
<?php snippet(
  'layouts/default',
  ['grid' => true],
  slots: true
)
?>

<!-- Main -->
<?php slot('main') ?>

<hgroup class="lg:text-center space-y-xs">
  <h1 class="uppercase tracking-wide">
    <?= $page->pageTitle() ?>
  </h1>
  <p>
    <?= t('base.posts.published') ?> <?= $page->published() ?><?php if ($taxonomy = $page->taxonomy()): ?> · <?= $taxonomy ?><?php endif ?>
  </p>
</hgroup>

<figure class="medium">
  <?php if ($cover = $page->cover()): ?>
    <?php snippet('image', [
      'image' => $cover,
      'sizes' => '(min-width: 1840px) 293px, (min-width: 1400px) calc(4.29vw + 215px), (min-width: 1000px) calc(32.89vw - 68px), (min-width: 620px) calc(49.44vw - 65px), calc(99.67vw - 61px)'
    ]) ?>
  <?php endif ?>
</figure>

<?= $page->contentBlocks()->toBlocks() ?>

<?php snippet('prevnext') ?>

<?php endslot() ?>