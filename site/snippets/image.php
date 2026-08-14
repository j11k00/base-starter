<?php

/** @var Kirby\Cms\File|null $image */
/** @var string|null $sizes */
/** @var string|null $srcset */
/** @var string|null $loading */
/** @var string|null $decoding */
/** @var string|null $style */

if (!$image) {
    return;
}

$sizes    ??= '100vw';
$srcset   ??= 'default';
$loading  ??= 'lazy';
$decoding ??= 'async';
$style    ??= null;

// Fallback src that matches the smallest srcset entry
$srcsetConfig = option('thumbs.srcsets')[$srcset] ?? [];
$firstConfig  = reset($srcsetConfig);
$fallbackSrc  = $firstConfig
    ? $image->thumb($firstConfig)->url()
    : $image->url();
?>
<img
    alt="<?= esc($image->alt(), 'attr') ?>"
    src="<?= $fallbackSrc ?>"
    srcset="<?= $image->srcset($srcset) ?>"
    sizes="<?= esc($sizes, 'attr') ?>"
    loading="<?= $loading ?>"
    decoding="<?= $decoding ?>"
    width="<?= $image->width() ?>"
    height="<?= $image->height() ?>"<?= $style ? ' style="' . esc($style, 'attr') . '"' : '' ?>>
