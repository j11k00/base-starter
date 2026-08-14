<?php

return [
    'debug' => true,
    // ponytail: page cache off locally — cached HTML keeps pointing at the
    // previous Vite asset hash after a rebuild
    'cache' => ['pages' => ['active' => false]],
];
