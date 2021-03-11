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
    return array_merge(...$nodes);
}

/* Принимает на вход директорию, находит внутри нее картинки и "сжимает" их.
Под сжиманием понимается уменьшение свойства size в метаданных в два раза.
Функция должна вернуть обновленную директорию со сжатыми картинками и всеми остальными данными,
которые были внутри этой директории. Картинками считаются все файлы заканчивающиеся на .jpg. */
function compressImages(array $tree)
{
    $children = getChildren($tree);
    $compressedChildren = array_map(function ($child) {
        $name = getName($child);
        if (!isFile($child) || !str_ends_with($name, '.jpg')) {
            return $child;
        }

        $meta = getMeta($child);
        $meta['size'] /= 2;

        return mkfile($name, $meta);
    }, $children);

    return mkdir(getName($tree), $compressedChildren, getMeta($tree));
}


function changeOwner(array $tree, string $owner)
{
    $name = getName($tree);
    $meta = getMeta($tree);
    $meta['owner'] = $owner;

    if(isFile($tree)) {
        return mkfile($name, $meta);
    }

    $children = getChildren($tree);
    $newChildren = array_map(function ($child) use ($owner) {
        return changeOwner($child, $owner);
    }, $children);

    return mkdir($name, $newChildren, $meta);
}