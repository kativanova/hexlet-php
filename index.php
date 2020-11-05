<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\AddDigits\addDigits;

var_dump(addDigits(0)); // 0
var_dump(addDigits(919)); // 1