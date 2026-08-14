<?php
/**
 * Generic post-type card (news / blog article, or any MuotoPage).
 *
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Cms\Page $post
 * @var bool|null $excerpt
 */
?>
<?php snippet('card', [
  'title' => $post->title(),
  'link'  => $post->url(),
  'meta'  => $post->listMeta(),
  'text'  => ($excerpt ?? true) !== false ? $post->summary() : null,
], slots: true) ?>
<?php if ($cover = $post->cover()): ?>
<?php slot('media') ?>
<?php snippet('image', ['image' => $cover]) ?>
<?php endslot() ?>
<?php endif ?>
<?php endsnippet() ?>
