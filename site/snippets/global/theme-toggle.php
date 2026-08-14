<?php
/**
 * @var \Kirby\Cms\App $kirby
 * @var \Kirby\Cms\Site $site
 * @var \Kirby\Cms\Page $page
 */
?>
<button
  x-data="themeToggle"
  @click="toggle"
  :aria-label="isDark ? '<?= t('base.theme.toLight') ?>' : '<?= t('base.theme.toDark') ?>'"
  class="nojs:hidden inline-flex rounded-full text-bg bg-contrast-high p-3 [&_svg]:size-4 [&_svg]:stroke-current">
  <!-- Sun icon (light mode) -->
  <svg
    x-show="!isDark"
    x-cloak
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round">
    <circle cx="12" cy="12" r="4" />
    <path d="M12 2v2" />
    <path d="M12 20v2" />
    <path d="m4.93 4.93 1.41 1.41" />
    <path d="m17.66 17.66 1.41 1.41" />
    <path d="M2 12h2" />
    <path d="M20 12h2" />
    <path d="m6.34 17.66-1.41 1.41" />
    <path d="m19.07 4.93-1.41 1.41" />
  </svg>
  <!-- Moon icon (dark mode) -->
  <svg
    x-show="isDark"
    x-cloak
    xmlns="http://www.w3.org/2000/svg"
    fill="none"
    viewBox="0 0 24 24"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round">
    <path
      d="M20.985 12.486a9 9 0 1 1-9.473-9.472c.405-.022.617.46.402.803a6 6 0 0 0 8.268 8.268c.344-.215.825-.004.803.401" />
  </svg>
</button>