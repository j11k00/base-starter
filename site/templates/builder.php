<?php

/**
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
<?= $page->template() ?>
<section class="space-y-3xl py-3xl mt-3xl">
	<?php snippet('layouts', ['field' => $page->layout()])  ?>
</section>
<?php endslot() ?>