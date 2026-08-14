<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>
<header class="py-2xl">
  <h1 class="uppercase tracking-wide"><?= $page->headline()->or($page->title())->esc() ?></h1>
  <?php if ($page->subheadline()->isNotEmpty()): ?>
    <p class="text-contrast-medium"><?= $page->subheadline()->esc() ?></p>
  <?php endif ?>
</header>