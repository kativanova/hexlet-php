<?php

namespace App\trees;

require __DIR__ . '/../vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\array_flatten;
use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;
use function Php\Immutable\Fs\Trees\trees\isDirectory;
use function Php\Immutable\Fs\Trees\trees\reduce;

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

function getFilesCount(array $tree)
{
    if (isFile($tree)) {
        return 1;
    }

    $children = getChildren($tree);
    /*
    $count = 0;
    foreach($children as $child) {
        $count += getFilesCount($child);
    }

    return $count;
*/
    /*
    return array_reduce($children, function ($acc, $child) {
        $acc += getFilesCount($child);
        return $acc;
    }, 0);
 */
    return array_reduce($children, fn ($acc, $child)  => $acc += getFilesCount($child), 0);
}

function getSubdirectoriesInfo($tree)
{
    $children = getChildren($tree);
    $directories = array_filter($children, fn ($child) => isDirectory($child));
    /*
    $result = [];
    foreach ($directories as $directory) {
        $name = getName($directory);
        $numOfChildren = getFilesCount($directory);
        $result[] = [
            $name,
            $numOfChildren
        ];
    }
    return $result;
*/
    /*
    return array_map(function ($directory) {
        return [getName($directory), getFilesCount($directory)];
    }, $directories);
 */
    return array_map(fn ($directory) => [getName($directory), getFilesCount($directory)], $directories);
}

function getSpaceUsage(array $tree)
{
    if (isFile($tree)) {
        $meta = getMeta($tree);
        if (isset($meta['size'])) {
            return $meta['size'];
        }
    }

    $chidren = getChildren($tree);

    return array_reduce($chidren, fn ($acc, $child) => $acc += getSpaceUsage($child), 0);
}

function du(array $tree)
{
    $directoriesWithSizes = array_map(fn ($chid) => [getName($chid), calculateFilesSize($chid)], getChildren($tree));

    usort($directoriesWithSizes, fn ($arr1, $arr2) => $arr2[1] <=> $arr1[1]);

    return $directoriesWithSizes;
}

function calculateFilesSize($node)
{
    return reduce(function ($acc, $n) {
        if (isDirectory($n)) {
            return $acc;
        }

        $meta = getMeta($n);

        return $acc + $meta['size'];
    }, $node, 0);
}

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

function findEmptyDirPaths($tree)
{
    return iter($tree, getName($tree));
}

function iter($tree, $rootName, $path = '')
{
    $name = getName($tree);
    $children = getChildren($tree);

    if ($name != $rootName) {
        $path .= "/{$name}";
    }
    if ($children == []) {
        return $path;
    }

    $directories = array_filter($children, fn ($child) => isDirectory($child));

    $result = array_map(fn ($directory) => iter($directory, $rootName, $path), $directories);
/*
    $result = [];
    foreach ($directories as $directory) {
        $listOfEmptyDirectories = iter($directory, $rootName, $path);
        $result[] = $listOfEmptyDirectories;
    }
*/

    return array_flatten($result);
}

function findFilesByName(array $tree, string $needle)
{
    return iter2($tree, $needle, getName($tree));
}

function iter2(array $tree, string $needle, string $rootName, string $path = '')
{
    $name = getName($tree);

    if ($name != $rootName) {
        $path .= "/{$name}";
    }

    if (isFile($tree)) {
        if (str_contains($name, $needle)) {
            return $path;
        }
        return [];
    }
    $children = getChildren($tree);

    $result = array_map(function ($child) use ($needle, $rootName, $path) {
        return iter2($child, $needle, $rootName, $path);
    }, $children);

    return $result;
}
