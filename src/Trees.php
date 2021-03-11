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

    if (isFile($tree)) {
        return mkfile($name, $meta);
    }

    $children = getChildren($tree);
    $newChildren = array_map(function ($child) use ($owner) {
        return changeOwner($child, $owner);
    }, $children);

    return mkdir($name, $newChildren, $meta);
}

/* принимает на вход директорию (объект-дерево) и приводит имена всех файлов в этой
и во всех вложенных директориях к нижнему регистру. Результат в виде обработанной
директории возвращается наружу. Исходное дерево не изменяется. */
function downcaseFileNames(array $tree)
{
    $name = getName($tree);
    $meta = getMeta($tree);

    if (isFile($tree)) {
        $newName = strtolower($name);
        return mkfile($newName, $meta);
    }

    $children = getChildren($tree);
    /*     $newChildren = array_map(function ($child) {
        return downcaseFileNames($child);
    }, $children); */

    $newChildren = [];
    foreach ($children as $child) {
        $newChild = downcaseFileNames($child);
        $newChildren[] = $newChild;
    }

    return mkdir($name, $newChildren, $meta);
}


$tree = mkdir('/', [
    mkdir('etc', [
        mkfile('bashrc'),
        mkfile('consul.cfg'),
    ]),
    mkfile('hexletrc'),
    mkdir('bin', [
        mkfile('ls'),
        mkfile('cat'),
    ]),
]);

function getNodesCount(array $node)
{
    if (isFile($node)) {
        return 1;
    }

    $children = getChildren($node);

/*     $count = 0;
    foreach ($children as $child) {
        $childsCount = getNodesCount($child);
        $count += $childsCount;
    } */

    $count = 0;

    return 1 + array_reduce($children, function ($acc, $child) {
        $acc += getNodesCount($child);
        return $acc;
    }, $count);
}

/* считает количество скрытых файлов в директории и всех поддиректориях.
Скрытым файлом в Linux системах считается файл, название которого начинается с точки. */
function getHiddenFilesCount($tree)
{
    $name = getName($tree);
    if (isFile($tree)) {
        return str_starts_with($name, '.') ? 1 : 0;
    }

    $chidren = getChildren($tree);

    return array_reduce($chidren, function ($acc, $child) {
        $acc += getHiddenFilesCount($child);
        return $acc;
    }, 0);
}

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
