<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\Ticket\isHappy;

var_dump(isHappy('385916')); //true
var_dump(isHappy('231002')); //false
var_dump(isHappy('1222')); //false
var_dump(isHappy('054702')); //true
var_dump(isHappy('00')); //true