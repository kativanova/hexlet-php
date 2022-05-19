<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке

use function App\Solution\combine;


print_r(combine([
    ['a' => 1, 'b' => 2, 'c' => 3],
    [],
    ['a' => 3, 'b' => 2, 'd' => 5],
    ['a' => 3],
    ['b' => 4, 'c' => 3, 'd' => 2],
    ['e' => 9],
]));
