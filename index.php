<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;
use function App\trees\changeOwner;


$tree = mkdir('/', [
    mkdir('etc', [
      mkdir('apache'),
      mkdir('nginx', [
        mkfile('nginx.conf'),
      ]),
      mkdir('consul', [
        mkfile('config.json'),
        mkdir('data'),
      ]),
    ]),
    mkdir('logs'),
    mkfile('hosts'),
  ]);

  print_r(changeOwner($tree, 'root'));