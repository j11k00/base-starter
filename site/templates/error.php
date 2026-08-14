<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>
<?php snippet(
  'layouts/default',
  ['showTitle' => false],
  slots: true
)
?>

<!-- Main -->
<?php slot('main') ?>
<div class="flex-1 flex items-center justify-center">
  <article class="text-center">
    <h1>
      <span class="uppercase tracking-wider"><?= t('base.error.title') ?></span>
      <span>😱</span>
    </h1>
    <div class="text">
      <p><?= t('base.error.text') ?></p>
    </div>
  </article>
</div>
<?php endslot() ?>