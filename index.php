<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\Numbers\isPerfect;

var_dump(isPerfect(6)); //true
var_dump(isPerfect(28)); //true
var_dump(isPerfect(14)); //true
var_dump(isPerfect(66)); //true
var_dump(isPerfect(33550336)); //true