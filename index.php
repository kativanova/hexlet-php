<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\Solution\sumIntervals;

/* echo sumIntervals([
    [1, 2],
    [11, 12]
 ]); // 2
 */
echo sumIntervals([
    [1, 9],
    [7, 12],
    [3, 4]
 ]); // 11 */
 echo sumIntervals([
    [1, 5],
    [-10, 19],
    [1, 7],
    [16, 100],
    [5, 11]
 ]); // 110