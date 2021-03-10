<?php

namespace App\removeFirstLevel;

/* Принимает на вход дерево, и возвращает новое,
элементами которого являются дети вложенных узлов */
function removeFirstLevel(array $tree)
{
    $nodes = array_filter($tree, function ($node) {
        return is_array($node);
    });
    return array_merge(... $nodes);
}