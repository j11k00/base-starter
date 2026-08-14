<?php

/**
 * Shared site footer.
 *
 * @var \Kirby\Cms\Site $site
 * @var string|null $class Extra classes (e.g. 'container mx-auto')
 */

$class ??= null;
?>
<footer class="py-md flex justify-between items-center<?= $class ? ' ' . esc($class, 'attr') : '' ?>" role="contentinfo">
  <p class="flex gap-[1ch] items-center">
    <span>Ⓒ</span>
    <a href="<?= $site->url() ?>"><?= $site->title() ?></a>
    <time><?= date("Y"); ?></time>
  </p>
  <a href="#page"><?= t('base.backToTop') ?></a>
</footer>
