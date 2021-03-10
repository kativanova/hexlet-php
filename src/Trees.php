<?php

namespace App\removeFirstLevel;

/* Принимает на вход дерево, и возвращает новое, 
элементами которого являются дети вложенных узлов */
function removeFirstLevel(array $tree)
{
    $result = [];
    foreach ($tree as $node) {
        if (is_array($node)) {
            foreach ($node as $leaf) {
                $result[] = $leaf;
            }
        }
    }
    return $result;
}