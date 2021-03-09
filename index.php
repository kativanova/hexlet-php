<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function App\Arrays\findWhere;

$data = [
  ['title' => 'Book of Fooos', 'author' => 'FooBar', 'year' => 1111],
  ['title' => 'Cymbeline', 'author' => 'Shakespeare', 'year' => 1611],
  ['title' => 'The Tempest', 'author' => 'Shakespeare', 'year' => 1611],
  ['title' => 'Book of Foos Barrrs', 'author' => 'FooBar', 'year' => 2222],
  ['title' => 'Still foooing', 'author' => 'FooBar', 'year' => 3333],
  ['title' => 'Happy Foo', 'author' => 'FooBar', 'year' => 4444],
];
$where1 = ['author' => 'Shakespeare', 'year' => 1612];
print_r(findWhere($data, $where1));