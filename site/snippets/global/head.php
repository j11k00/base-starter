<?php

/**
 * Shared document <head> for all layouts.
 *
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>

<head>

  <!-- Theme initialization (prevent flash) -->
  <script>
    (function() {
      const savedTheme = localStorage.getItem('theme');
      const systemPreference = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
      const theme = savedTheme || systemPreference;
      document.documentElement.setAttribute('data-theme', theme);
    })();
  </script>

  <!-- Document -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Title -->
  <title>
    <?= $site->title()->esc() ?> –
    <?= $page->pageTitle()->esc() ?>
  </title>

  <!-- SEO / Meta -->
  <?php snippet('seo/head'); ?>

  <!-- Theme color -->
  <meta name="theme-color" media="(prefers-color-scheme: light)" content="#fefefe">
  <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#121212">

  <!-- Icons -->
  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>">
  <link rel="icon" href="<?= url('favicon.svg') ?>" sizes="any" type="image/svg+xml" />

  <!-- Styles & Scripts (Alpine is bundled via the Vite entry) -->
  <?= vite()->js('index.js', ['defer' => true]) ?>
  <?= vite()->css('index.js') ?>

  <?php /* Add a preload per brand font once src/css/fonts.css has real @font-face rules:
  <link rel="preload" href="<?= vite()->file('assets/fonts/YourFont-Regular.woff2') ?>" as="font" type="font/woff2" crossorigin>
  */ ?>

</head>