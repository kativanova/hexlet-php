<?php

namespace App\trees;

require __DIR__ . '/../vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;

/* Принимает на вход дерево, и возвращает новое,
элементами которого являются дети вложенных узлов */
function removeFirstLevel(array $tree)
{
    $nodes = array_filter($tree, function ($node) {
        return is_array($node);
    });
    return array_merge(... $nodes);
}

/* Принимает на вход директорию, находит внутри нее картинки и "сжимает" их.
Под сжиманием понимается уменьшение свойства size в метаданных в два раза.
Функция должна вернуть обновленную директорию со сжатыми картинками и всеми остальными данными,
которые были внутри этой директории. Картинками считаются все файлы заканчивающиеся на .jpg. */
function compressImages(array $tree)
{
    $newTree = [];
    $children = getChildren($tree);
    $compressedChildren = array_map(function ($child) {
        if (isFile($child)) {
            $name = getName($child);
            $meta = getMeta($child);
            if (strpos($name, '.jpg') == strlen($name) - 4) {
                $meta['size'] = $meta['size'] / 2;
            }
            return mkfile($name, $meta);
        }
        return $child;
    }, $children);

    $newTree = mkdir(getName($tree), $compressedChildren, getMeta($tree));

    return $newTree;
}