<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function App\Arrays\getSortedNames;

$users = [
  ['name' => 'Bronn', 'gender' => 'male', 'birthday' => '1973-03-23'],
  ['name' => 'Reigar', 'gender' => 'male', 'birthday' => '1973-11-03'],
  ['name' => 'Eiegon',  'gender' => 'male', 'birthday' => '1963-11-03'],
  ['name' => 'Sansa', 'gender' => 'female', 'birthday' => '2012-11-03']
];

print_r(getSortedNames($users)); // ['Bronn', 'Eiegon', 'Reigar', 'Sansa']