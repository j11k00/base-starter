<?php

/**
 * Shared options come from the kit; only site-specific ones live here.
 *
 * array_replace_recursive merges *lists* by index, so overriding
 * `blocks.fieldsets` means restating the whole list — a partial list
 * silently truncates the kit's.
 */

return array_replace_recursive(

    require __DIR__ . '/../plugins/base-kit/config.php',

    [
        'debug' => false,
        'cache' => ['pages' => ['active' => true]],

        // 'locale'                     => 'fi_FI.utf-8',
        // 'tobimori.seo.canonicalBase' => 'https://www.example.fi',
    ]

);
