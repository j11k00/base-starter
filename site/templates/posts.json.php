<?php

/**
 * JSON representation of the posts listing (same controller as posts.php).
 * Used for live filtering / infinite scroll.
 *
 * @var \Kirby\Cms\Pages $posts
 * @var string|null $tag
 */

$pagination = $posts->pagination();

echo json_encode([
    'page'  => $pagination->page(),
    'pages' => $pagination->pages(),
    'tag'   => $tag,
    'data'  => array_values($posts->toArray(fn ($post) => [
        'url'      => $post->url(),
        'title'    => (string)$post->pageTitle(),
        'date'     => (string)$post->pubDate(),
        'taxonomy' => $post->taxonomy(),
        'tags'     => $post->tags()->split(','),
        'cover'    => $post->cover()?->url(),
    ])),
]);
