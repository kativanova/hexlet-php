<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use Hexlet\Php\Runner;
use function Hexlet\Php\Binary\binarySum;

//print_r(Runner\run());


echo binarySum('10', '1'); // 11
echo "\n";
echo binarySum('1101', '101'); // 10010
echo "\n";
