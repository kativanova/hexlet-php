<?php

/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function App\trees\compressImages;


$tree = mkdir('my documents', [
    mkdir('documents.jpg'),
    mkfile('avatar.jpg', ['size' => 100]),
    mkfile('passport.jpg', ['size' => 200]),
    mkfile('family.jpg', ['size' => 150]),
    mkfile('addresses', ['size' => 125]),
    mkdir('presentations')
], [ 'test' => 'haha']);

$newTree = compressImages($tree);

//print_r($tree);
print_r($newTree);