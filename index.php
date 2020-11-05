<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\Brackets\isBalanced;

var_dump(isBalanced('(())')); // true
var_dump(isBalanced('((())')); // false
var_dump(isBalanced(')((())')); // false
var_dump(isBalanced('')); // true
var_dump(isBalanced('(()())')); // true
var_dump(isBalanced('((a)*(b))')); // true