<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function App\Arrays\flatten;


// Для пустого массива возвращается []
print_r(flatten([])); // []
print_r(flatten([1, [3, 2], 9])); // [1, 3, 2, 9]
print_r(flatten([1, [[2], [3]], [9]])); // [1, [2], [3], 9]