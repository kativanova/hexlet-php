<?php

namespace App\Solution;

use function Funct\Strings\length;

function combine($arrayList)
{
    $merged = [];
    foreach ($arrayList as $arr) {
        foreach ($arr as $key => $value) {
            if (!array_key_exists($key, $merged)) {
                $merged[$key] = [$value];
            } else {
                if (!in_array($value, $merged[$key])) {
                    $merged[$key][] = $value;
                }
            }
        }
    }
    return $merged;
}


function scrabble($letters, $word): bool
{
    if (strlen($letters) < strlen($word)) {
        return false;
    }

    $lettersArr = countLetters(strtolower($letters));
    $wordArr = countLetters(strtolower($word));

    foreach ($wordArr as $wordLetter => $count) {
        if (!array_key_exists($wordLetter, $lettersArr) || $lettersArr[$wordLetter] < $count) {
            return false;
        }
    }

    return true;
}

function countLetters($lettersList)
{
    $letters = str_split($lettersList);
    return array_count_values($letters);
}

const ARABIC = [1, 4, 5, 9, 10, 40, 50, 90, 100, 400, 500, 900, 1000];
const ROMAN = ['I', 'IV', 'V', 'IX', 'X', 'XL', 'L', 'XC', 'C', 'CD', 'D', 'CM', 'M'];

function toRoman($number)
{
    $position = count(ARABIC) - 1;
    $roman = '';

    while ($number > 0) {
        if ($number >= ARABIC[$position]) {
            $roman = $roman . ROMAN[$position];
            $number -= ARABIC[$position];
        } else {
            $position -= 1;
        }
    }

    return $roman;
}
