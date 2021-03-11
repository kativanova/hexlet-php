<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function App\trees\getHiddenFilesCount;

$tree = mkdir('/', [
  mkdir('etc', [
      mkdir('apache', []),
      mkdir('nginx', [
          mkfile('.nginx.conf', ['size' => 800]),
      ]),
      mkdir('.consul', [
          mkfile('.config.json', ['size' => 1200]),
          mkfile('data', ['size' => 8200]),
          mkfile('raft', ['size' => 80]),
      ]),
  ]),
  mkfile('.hosts', ['size' => 3500]),
  mkfile('resolve', ['size' => 1000]),
]);

echo getHiddenFilesCount($tree);
echo PHP_EOL;