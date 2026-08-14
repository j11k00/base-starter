<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
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
<?= $page->text()->toBlocks() ?>
<?php endslot() ?>