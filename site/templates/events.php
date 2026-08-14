<?php

/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 * @var string|null $tag
 * @var \Kirby\Cms\Pages $events
 * @var \EventPage|null $eventNext
 * @var \Kirby\Cms\Pages $eventsUpcoming
 * @var \Kirby\Cms\Pages $eventsPast
 * @var \Kirby\Toolkit\Collection $eventsGrouped
 */
?>
<?php snippet(
  'layouts/default',
  slots: true
)
?>

<!-- Main -->
<?php slot('main') ?>


<div class="space-y-3xl">

  <!-- Next event -->
  <h2><?= t('base.events.next') ?></h2>
  <?php if ($eventNext): ?>
    <?php snippet('cards', ['items' => new Kirby\Cms\Pages([$eventNext])]) ?>
  <?php else: ?>
    <p><?= t('base.events.none') ?></p>
  <?php endif ?>

  <!-- Upcoming events -->
  <h2><?= t('base.events.upcoming') ?></h2>
  <?php if ($eventsUpcoming->isNotEmpty()): ?>
    <?php snippet('cards', ['items' => $eventsUpcoming]) ?>
  <?php else: ?>
    <p><?= t('base.events.none') ?></p>
  <?php endif ?>

  <!-- Past events -->
  <h2><?= t('base.events.past') ?></h2>
  <?php if ($eventsPast->isNotEmpty()): ?>
    <?php snippet('cards', ['items' => $eventsPast]) ?>
  <?php else: ?>
    <p><?= t('base.events.nonePast') ?></p>
  <?php endif ?>

  <!-- Grouped events -->
  <h2><?= t('base.events.grouped') ?></h2>
  <?php foreach ($eventsGrouped as $year => $months): ?>
    <section class="p-m border-t-2">

      <h3><?= esc($year) ?></h3>
      <?php foreach ($months as $month => $days): ?>
        <h4><?= esc($month) ?></h4>
        <ul>
          <?php foreach ($days as $day => $dayEvents): ?>
            <li class="py-md border-t-2 grid grid-cols-[1fr_4fr] gap-md">

              <h5><?= esc($day) ?></h5>
              <?php foreach ($dayEvents as $event): ?>
                <p>
                  <?= $event->title() ?>
                  <?= $event->startTime()->toDate('HH:mm') ?>
                </p>
              <?php endforeach ?>
            </li>
          <?php endforeach ?>
        </ul>
      <?php endforeach ?>
    </section>
  <?php endforeach ?>

  <!-- All events -->
  <h2><?= t('base.events.all') ?></h2>
  <?php snippet('cards', ['items' => $events]) ?>

  <?php snippet('pagination', ['pagination' => $events->pagination()]) ?>

</div>

<?php endslot() ?>