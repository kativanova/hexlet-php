<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use function App\Arrays\getIn;

$data = [
  'user' => 'ubuntu',
  'hosts' => [
      ['name' => 'web1'],
      ['name' => 'web2', null => 3, 'active' => false]
  ]
];

/* print_r(getIn($data, ['undefined'])); // null
print_r(getIn($data, ['user'])); // 'ubuntu'
getIn($data, ['user', 'ubuntu']); // null
print_r(getIn($data, ['hosts', 1, 'name'])); // 'web2' */
var_dump(getIn($data, ['hosts', 0])); // ['name' => 'web1']
//getIn($data, ['hosts', 1, null]); // 3
//getIn($data, ['hosts', 1, 'active']); // false

