<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 * @var string|null $tag
 * @var \Kirby\Cms\Pages $posts
 */
?>
<?php snippet(
  'layouts/default',
  slots: true
)
?>

<!-- Main -->
<?php slot('main') ?>

<?php if (empty($tag) === false): ?>
  <header>
    <h1>
      <small><?= t('base.tag') ?>:</small> <?= esc($tag) ?>
      <a href="<?= $page->url() ?>" aria-label="<?= t('base.posts.all') ?>">&times;</a>
    </h1>
  </header>
<?php else: ?>
  <?php snippet('intro') ?>
<?php endif ?>

<?php snippet('cards', [
  'items'    => $posts,
  'meta'     => fn ($post) => $post->taxonomy(),
  'showText' => false,
]) ?>

<?php snippet('pagination', ['pagination' => $posts->pagination()]) ?>

<?php endslot() ?>