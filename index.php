<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке

use function App\Arrays\buildSnailPath;
use function App\Arrays\rotateLeft;

print_r(buildSnailPath([
    [1, 2],
    [3, 4],
  ])); // [1, 2, 4, 3]
  
   print_r(buildSnailPath([
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 11, 12],
  ])); // [1, 2, 3, 4, 8, 12, 11, 10, 9, 5, 6, 7]

  print_r(rotateLeft([]));