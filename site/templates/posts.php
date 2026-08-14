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

<?php /* The page heading is the layout's global/title. A tag narrows the list,
         it doesn't retitle the page — so this is a filter notice, not an h1. */ ?>
<?php if (empty($tag) === false): ?>
  <p class="py-md">
    <small><?= t('base.tag') ?>:</small> <?= esc($tag) ?>
    <a href="<?= $page->url() ?>" aria-label="<?= t('base.posts.all') ?>">&times;</a>
  </p>
<?php endif ?>

<?php snippet('cards', [
  'items'    => $posts,
  'meta'     => fn ($post) => $post->taxonomy(),
  'showText' => false,
]) ?>

<?php snippet('pagination', ['pagination' => $posts->pagination()]) ?>

<?php endslot() ?>