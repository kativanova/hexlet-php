<?php

namespace Hexlet\Php\AddDigits;

function addDigits(int $number): int
{
    $numberStr = (string) $number;
    $strLenght = strlen($numberStr);

    while ($strLenght > 1) {
        $sum = 0;
        for ($i = 0; $i < $strLenght; $i++) {
            $sum += (int) $numberStr[$i];
        }
        $numberStr = (string) $sum;
        $strLenght = strlen($numberStr);
    }
    return (int) $numberStr;
}
