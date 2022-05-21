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

const NUMERALS = [
    "M" => 1000,
    "CM" => 900,
    "D" => 500,
    "CD" => 400,
    "C" => 100,
    "XC" => 90,
    "L" => 50,
    "XL" => 40,
    "X" => 10,
    "IX" => 9,
    "V" => 5,
    "IV" => 4,
    "I" => 1,
];

function toRoman($number)
{
    $result = '';
    foreach (NUMERALS as $roman => $arabic) {
        if ($number >= $arabic) {
            $result .= str_repeat($roman, $number / $arabic);
            $number %= $arabic;
        }
    }

    return $result;
}

function toArabic($number)
{
    $result = 0;
    $position = 0;

    foreach (NUMERALS as $roman => $arabic) {
        $partOfNumber = substr($number, $position, strlen($roman));
        $counter = 0;
        while ($partOfNumber === $roman) {
            $position += strlen($roman);
            $counter += 1;
            $partOfNumber = substr($number, $position, strlen($roman));
        }
        if (
            $counter > 3
            || ((strlen($roman) === 2) && $counter > 1)
        ) {
                return false;
        } else {
            $result += $counter * $arabic;
        }
    }

    return $position === strlen($number) ? $result : false;
}
