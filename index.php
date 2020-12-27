<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function Hexlet\Php\Solution\genDiff;

$result = genDiff(
  ['one' => 'eon', 'two' => 'two', 'four' => true],
  ['two' => 'own', 'zero' => 4, 'four' => true]
);
print_r($result);
// [
//   'one' => 'deleted',
//   'two' => 'changed',
//   'four' => 'unchanged',
//   'zero' => 'added',
// ]