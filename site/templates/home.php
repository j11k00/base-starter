<?php

/**
 * Bespoke home page.
 *
 * This template is yours to rewrite per project — the home page is the one
 * page that rarely fits a block canvas, so base-kit deliberately ships no
 * `home` blueprint or template. What is here is a starting point: a
 * hand-written hero, then the editor's blocks underneath.
 *
 * Every other top-level page (about, contact, landing pages) still uses
 * `builder` and is composed from blocks.
 *
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>
<?php snippet(
  'layouts/default',
  slots: true
)
?>

<!-- Main -->
<?php slot('main') ?>

<section class="wrapper py-3xl">

  <?php if ($cover = $page->cover()): ?>
    <?php snippet('image', ['image' => $cover]) ?>
  <?php endif ?>

  <h1 class="text-6xl uppercase tracking-wide py-lg">
    <?= $page->heroTitle()->or($page->pageTitle())->esc() ?>
  </h1>

  <?php if ($page->heroLede()->isNotEmpty()): ?>
    <div class="prose text-xl max-w-prose">
      <?= $page->heroLede() ?>
    </div>
  <?php endif ?>

  <?php $links = $page->heroLinks()->toStructure(); ?>
  <?php if ($links->isNotEmpty()): ?>
    <div class="m-links py-lg" data-style="buttons">
      <?php foreach ($links as $item): ?>
        <?php [$href, $label] = MuotoBlockHelpers::blockLink($item->link(), $item->linkText()); ?>
        <?php if ($href === '') continue ?>
        <a class="button" href="<?= esc($href) ?>"><?= esc($label) ?></a>
      <?php endforeach ?>
    </div>
  <?php endif ?>

</section>

<?php if ($page->contentBlocks()->isNotEmpty()): ?>
  <section class="space-y-3xl py-3xl">
    <?= $page->contentBlocks()->toBlocks() ?>
  </section>
<?php endif ?>

<?php endslot() ?>
