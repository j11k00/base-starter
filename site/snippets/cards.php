<?php

/**
 * Alpine-animated card grid for collection items (events, posts).
 * Works with any page object — cover(), listMeta() and listSummary()
 * are page methods with generic defaults.
 *
 * @var \Kirby\Cms\Pages $items
 * @var \Closure|null $meta     fn ($item): string — meta line, defaults to listMeta()
 * @var \Closure|null $text     fn ($item): mixed — card text, defaults to listSummary()
 * @var bool|null $showText     Render the text line (default: true)
 * @var string|null $sizes      img sizes attribute for the card cover
 */

$meta     ??= fn($item) => $item->listMeta();
$text     ??= fn($item) => $item->listSummary();
$showText ??= true;
$sizes    ??= '(min-width: 1840px) 293px, (min-width: 1400px) calc(4.29vw + 215px), (min-width: 1000px) calc(32.89vw - 68px), (min-width: 620px) calc(49.44vw - 65px), calc(99.67vw - 61px)';
?>
<ul
  role="list"
  data-width="wide"
  class="grid-ram gap-xl"
  style="--min: 35ch">

  <?php foreach ($items as $item): ?>
    <li
      x-data="{ shown: false }"
      x-intersect.once="shown = true"
      class="transition duration-700 ease-out will-change-transform"
      :style="shown ? 'opacity: 1; transform: none' : 'opacity: 0; transform: translateY(1rem)'">

      <!-- Card -->
      <?php snippet('card', [
        'title' => $item->title(),
        'link'  => $item->url(),
        'text'  => $showText ? $text($item) : null,
        'meta'  => $meta($item),
      ], slots: true) ?>

      <!-- Media -->
      <?php if ($cover = $item->cover()): ?>
        <?php slot('media') ?>
        <?php snippet('image', ['image' => $cover, 'sizes' => $sizes]) ?>
        <?php endslot() ?>
      <?php endif ?>
      <?php endsnippet() ?>

    </li>
  <?php endforeach ?>
</ul>