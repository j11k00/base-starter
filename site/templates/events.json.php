<?php

/**
 * JSON representation of the events listing (same controller as events.php).
 * Used for live filtering / infinite scroll.
 *
 * @var \Kirby\Cms\Pages $events
 * @var string|null $tag
 */

$pagination = $events->pagination();

echo json_encode([
    'page'  => $pagination->page(),
    'pages' => $pagination->pages(),
    'tag'   => $tag,
    'data'  => array_values($events->toArray(fn ($event) => [
        'url'       => $event->url(),
        'title'     => (string)$event->pageTitle(),
        'date'      => (string)$event->startDate(),
        'dateLabel' => $event->dateLabel(),
        'taxonomy'  => $event->taxonomy(),
        'summary'   => (string)$event->listSummary(),
        'cover'     => $event->cover()?->url(),
    ])),
]);
