<?php

use Kirby\Cms\Field;

/**
 * Card Component
 *
 * @var string|null                     $variant   Card variant class suffix (default: 'default')
 * @var bool                            $showTitle Whether to render the title (default: true)
 * @var bool                            $showText  Whether to render the text (default: true)
 * @var bool                            $showMeta  Whether to render the meta line (default: true)
 * @var string|Field|null               $title
 * @var string|Field|null               $text      Supports KirbyText when passed as a Field
 * @var string|Field|null               $link
 * @var string|Field|null               $meta
 */

// Defaults
$variant   ??= 'default';
$showTitle ??= true;
$showText  ??= true;
$showMeta  ??= true;
$link      ??= null;
$title     ??= null;
$meta      ??= null;
$text      ??= null;

// esc() accepts Field directly (Stringable); only $text needs special
// handling since it renders as KirbyText instead of being escaped.
$text = $text instanceof Field ? $text->kt() : ($text !== null ? esc($text) : null);

?>

<article class="card card--<?= esc($variant, 'attr') ?> link-object">

  <div class="card__content">
    <!-- Header -->
    <?php if ($showTitle && $title): ?>
      <header class="card__header">
        <h3 class="card__title">
          <?php if ($link): ?>
            <a class="link-object__anchor" href="<?= esc($link, 'attr') ?>">
              <?= esc($title) ?>
            </a>
          <?php else: ?>
            <?= esc($title) ?>
          <?php endif ?>
        </h3>
      </header>
    <?php endif ?>

    <!-- Summary -->
    <?php if ($showText && $text): ?>
      <div class="card__text">
        <?= $text ?>
      </div>
    <?php endif ?>

    <!-- Meta -->
    <?php if ($showMeta && $meta): ?>
      <p class="card__meta">
        <?= esc($meta) ?>
      </p>
    <?php endif ?>

  </div>

  <?php if ($media = $slots->media()): ?>
    <figure class="card__media">
      <?= $media ?>
    </figure>
  <?php endif ?>

</article>