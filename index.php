<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function App\Arrays\pick;

$data = [
  'user' => 'ubuntu',
  'cores' => 4,
  'os' => 'linux',
  'null' => null
];

print_r(pick($data, ['user']));       // → ['user' => 'ubuntu']
print_r(pick($data, ['user', 'os'])); // → ['user' => 'ubuntu', 'os' => 'linux']
pick($data, []);             // → []
pick($data, ['none']);       // → []
var_dump(pick($data, ['null']));    // → ['null' => null]
