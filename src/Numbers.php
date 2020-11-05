<?php

namespace Hexlet\Php\Numbers;

function getDividers(int $number): array
{
    $dividers = array();
    for ($i = 1; $i <= $number / 2; $i++) {
        if ($number % $i === 0) {
            array_push($dividers, $i);
        }
    }
    return $dividers;
}

function isPerfect(int $number): bool
{
    $dividers = getDividers($number);

    return array_sum($dividers) === $number ? true : false;
}
