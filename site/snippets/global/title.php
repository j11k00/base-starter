<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>


<h1 <?= attr([
        'class' => $page->toggleVisibility()->toBool()
            ? 'sr-only'
            : 'text-6xl uppercase tracking-wide py-2xl',
    ]) ?>>
    <?= $page->title()->html() ?>
</h1>