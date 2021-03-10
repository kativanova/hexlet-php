<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function App\removeFirstLevel\removeFirstLevel;

// Второй уровень тут: 5, 3, 4

$tree1 = [[5], 1, [3, 4]]; 
print_r(removeFirstLevel($tree1)); // [5, 3, 4]

$tree2 = [];
print_r(removeFirstLevel($tree2)); // [3, 5, [4, 3], 2] */