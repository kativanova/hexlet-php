<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\Solution\multiply;

$matrixA = [[1, 2], [3, 2]];
$matrixB = [[3, 2], [1, 1]];

var_dump(multiply($matrixA, $matrixB));
// [[5, 4], [11, 8]]

 $matrixC = [
  [2, 5],
  [6, 7],
  [1, 8],
];
$matrixD = [
  [1, 2, 1],
  [0, 1, 0],
];

print_r(multiply($matrixC, $matrixD));
// [
//   [2, 9, 2],
//   [6, 19, 6],
//   [1, 10, 1],
// ]

