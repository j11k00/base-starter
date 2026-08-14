<?php
/**
 * Language switcher — renders nothing on single-language sites.
 *
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Page $page
 */
?>
<?php if ($kirby->multilang() && $kirby->languages()->count() > 1): ?>
<nav class="lang-switcher flex gap-2xs" aria-label="<?= t('base.language') ?>">
  <?php foreach ($kirby->languages() as $language): ?>
    <a
      class="no-underline uppercase"
      href="<?= $page->url($language->code()) ?>"
      hreflang="<?= $language->code() ?>"
      <?= $kirby->language()?->code() === $language->code() ? 'aria-current="true"' : '' ?>>
      <?= $language->code() ?>
    </a>
  <?php endforeach ?>
</nav>
<?php endif ?>
