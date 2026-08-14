<?php

/**
 * Shared HTML shell for all templates. Pass 'grid' => true for the
 * contained prose layout (single posts/events, default pages).
 *
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Template\Slots $slots
 * @var bool|null $grid
 * @var bool|null $showTitle
 */
$grid ??= false;

// A template that renders its own <h1> (an article header, a hero, the error
// page) passes showTitle => false; otherwise the shell supplies one. Declared
// by the caller rather than matched against a list of template names here —
// most templates now come from base-kit, and the shell shouldn't have to know
// their names to avoid emitting a second h1.
$showTitle ??= true;
?>

<!doctype html>
<html lang="<?= $kirby->language()?->code() ?? 'fi' ?>" data-theme="light">

<?php snippet('global/head') ?>

<body id="<?= $page->title()->slug() ?>">

  <div id="page" class="min-h-screen flex flex-col<?= $grid ? '' : ' wrapper' ?>">

    <!-- Nav -->
    <header class="py-md sticky top-0 bg-bg z-40<?= $grid ? ' container mx-auto' : '' ?>">
      <?php snippet('global/nav') ?>
    </header>

    <!-- Main -->
    <main id="main-content" class="flex-1 flex flex-col">
      <?php if ($grid): ?>
        <div class="page-layout py-3xl prose">
          <?php if ($showTitle) snippet('global/title') ?>
          <?= $slots->main() ?>
        </div>
      <?php else: ?>
        <?php if ($showTitle) snippet('global/title') ?>
        <?= $slots->main() ?>
      <?php endif ?>
    </main>

    <?php snippet('global/footer', ['class' => $grid ? 'container mx-auto' : null]) ?>

  </div>

  <!-- Schemas -->
  <?php snippet('seo/schemas'); ?>

</body>

</html>