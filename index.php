<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\Solution\isValidField;
use function Hexlet\Php\Solution\calcShipsCount;

var_dump(calcShipsCount([])); // 0

var_dump(calcShipsCount([
  [0, 1, 0, 0, 0, 0],
  [0, 1, 0, 1, 1, 1],
  [0, 0, 0, 0, 0, 0],
  [0, 1, 1, 1, 0, 1],
  [0, 0, 0, 0, 0, 1],
  [1, 1, 0, 1, 0, 0],
])); // 6

var_dump(isValidField([
    [0, 1, 0, 0],
    [0, 0, 0, 1],
    [0, 0, 0, 0],
    [0, 1, 1, 1],
  ])
); // false

