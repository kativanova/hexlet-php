<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке

use function App\Solution\toRoman;


echo toRoman(46);
echo PHP_EOL;
// 'I'
echo toRoman(59);
echo PHP_EOL;
// 'LIX'
echo toRoman(3000);
echo PHP_EOL;
// 'MMM'
