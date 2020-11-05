<?php

namespace Hexlet\Php\Brackets;

const OPEN_BRACKET = '(';
const CLOSE_BRACKET = ')';

function isBalanced(string $bracketsStr)
{
    $strLength = strlen($bracketsStr);
    $stack = '';

    for ($i = 0; $i < $strLength; $i++) {
        if ($bracketsStr[$i] === CLOSE_BRACKET || $bracketsStr[$i] == OPEN_BRACKET) {
            if (strlen($stack) === 0) {
                if ($bracketsStr[$i] === CLOSE_BRACKET) {
                    return false;
                } elseif ($bracketsStr[$i] === OPEN_BRACKET) {
                    $stack .= $bracketsStr[$i];
                }
            } elseif ($stack[strlen($stack) - 1] === $bracketsStr[$i]) {
                $stack .= $bracketsStr[$i];
            } else {
                $stack = substr($stack, 0, -1);
            }
        }
    }
    return strlen($stack) === 0 ? true : false;
}
