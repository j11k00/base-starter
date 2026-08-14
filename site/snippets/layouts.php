<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 * @var \Kirby\Content\Field $field
 */
?>
<?php foreach ($field->toLayouts() as $layout): ?>
  <section class="grid-ram gap-xl" id="<?= esc($layout->id(), 'attr') ?>" style="--min: 40ch">
    <?php foreach ($layout->columns() as $column): ?>
      <div>
        <?= $column->blocks() ?>
      </div>
    <?php endforeach ?>
  </section>
<?php endforeach ?>