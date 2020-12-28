<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use App\Map;

$map = Map\make();
/* $result = Map\get($map, 'key');
print_r($result); // => null

$result = Map\get($map, 'key', 'value');
print_r($result); // => value */

Map\set($map, 'key2', 'value2');
$result = Map\get($map, 'key2');
print_r($result); // => value2