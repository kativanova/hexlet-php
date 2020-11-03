<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use Hexlet\Php\Runner;
use function Hexlet\Php\Binary\binarySum;
use function Hexlet\Php\PowerOfThree\isPowerOfThree;

//print_r(Runner\run());


/* echo binarySum('10', '1'); // 11
echo "\n";
echo binarySum('1101', '101'); // 10010
echo "\n"; */

var_dump(isPowerOfThree(1)); // → true (3^0)
var_dump(isPowerOfThree(3)); // → true
var_dump(isPowerOfThree(4)); // → false
var_dump(isPowerOfThree(9)); // → true
var_dump(isPowerOfThree(0)); // → false
