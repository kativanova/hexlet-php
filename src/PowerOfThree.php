<?php

namespace Hexlet\Php\PowerOfThree;

/**Определяет, является ли переданное число натуральной степенью тройки.
 * Например, число 27 это третья степень (33), а 81 это четвертая (34).
 * */

function isPowerOfThree(int $number): bool
{

    if ($number === 0) {
        return false;
    } elseif ($number === 1 || $number % 3 === 0) {
        return true;
    } else {
        return false;
    }
}
