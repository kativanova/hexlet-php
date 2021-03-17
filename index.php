<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке

use function App\Arrays\buildSnailPath;
use function App\Arrays\generate;


print_r(generate(1)); // → [1, 1]
print_r(generate(4)); // → [1, 4, 6, 4, 1]
print_r(generate(6)); // → [1, 4, 6, 4, 1]