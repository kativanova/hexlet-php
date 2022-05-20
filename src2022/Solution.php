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
    foreach(NUMERALS as $roman => $arabic) {
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
    while ($position < strlen($number)) {
        $two_letter_number = substr($number, $position, 2);
        $one_letter_number = $number[$position];
        
        if (array_key_exists($two_letter_number, NUMERALS)) {
            $result += NUMERALS[$two_letter_number];
            $position += 2;
        } elseif (array_key_exists($one_letter_number, NUMERALS)) {
            $result += NUMERALS[$one_letter_number];
            $position += 1;
        } else {
            return false;
        }
    }

    return $result;
}
