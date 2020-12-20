<?php

namespace App\Arrays;

function flatten(array $arr)
{
    $result = [];
    foreach ($arr as $item) {
        if (is_array($item)) {
            $result = [...$result, ...$item];
        } else {
            $result[] = $item;
        }
    }
    return $result;
}

/* function flatten(array $arr)
{
    do {
        $isFlattened = false;
        $result = [];
        
        foreach ($arr as $item) {
            if (is_array($item)) {
                $result = [...$result, ...$item];
                $isFlattened = true;
            } else {
                $result[] = $item;
            }
        }
        $arr = $result;    
    } while ($isFlattened);
    return $arr;
} */

function getDistance(array $point1, array $point2)
{
    [$x1, $y1] = $point1;
    [$x2, $y2] = $point2;

    $xs = $x2 - $x1;
    $ys = $y2 - $y1;

    return sqrt($xs ** 2 + $ys ** 2);
}

function getTheNearestLocation($locationList, $currentPoint)
{
    if (empty($locationList)) {
        return null;
    }
    [$nearestLocation] = $locationList;
    $minDistance = getDistance($currentPoint, $nearestLocation[1]);

    foreach ($locationList as $location) {
        [, $point] = $location;
        $distance = getDistance($currentPoint, $point);
        if ($minDistance > $distance) {
            $minDistance = $distance;
            $nearestLocation = $location;
        }
    }
    return $nearestLocation;
}

// BEGIN (write your solution here)
function getIntersectionOfSortedArray(array $arr1, array $arr2)
{
    $result = [];
    $lenght1 = count($arr1);
    $lenght2 = count ($arr2);

    $index1 = 0;
    $index2 = 0;

    while ($index1 < $lenght1 && $index2 < $lenght2) {
        if ($arr1[$index1] === $arr2[$index2]) {
            $result[] = $arr1[$index1];
            $index1++;
            $index2++;
        } elseif ($arr1[$index1] > $arr2[$index2]) {
            $index2++;
        } else {
            $index1++;
        }
    }
    return $result;
}

function checkIfBalanced(string $expression)
{
    $stack = [];
    for($i = 0, $length = strlen($expression); $i < $length; $i++) {
        if ($expression[$i] === '(') {
            array_push($stack, '(');
        } elseif ($expression[$i] === ')') {
            if (!empty($stack)) {
                array_pop($stack);    
            } else {
                return false;
            }
        }
    }
    return count($stack) === 0;
}

function bubbleSort(array &$arr)
{
    $size = count($arr);
    do {
        $isSwitched = false;
        for($i = 0; $i < $size - 1; $i++) {
            if($arr[$i] > $arr [$i + 1]) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$i + 1];
                $arr[$i + 1] = $tmp;

                $isSwitched = true;
            }
        }

        $size = $size - 1;

    } while ($isSwitched === true);

    return $arr;
}

function countUniqChars(string $str)
{
    $uniqueChars = [];
    for ($i = 0; $i < strlen($str); $i++) {
        if(!in_array($str[$i], $uniqueChars)) {
            $uniqueChars[] = $str[$i];
        }
    }
    return count($uniqueChars);
}

function getSameCount(array $first, array $second)
{
    $first = removeDuplicates($first);
    $second = removeDuplicates($second);

    $countOfCommonElements = 0;
    foreach($first as $item) {
        if (in_array($item, $second, true)) {
            $countOfCommonElements += 1;
        }
    }
    return $countOfCommonElements;
}

function removeDuplicates(array $arr)
{
    $result = [];
    foreach ($arr as $item) {
        if (!in_array($item, $result)) {
            $result[] = $item;
        }
    }
    return $result;
}

function makeCensored(string $text, array $replacementList)
{
    if($text === '' || empty($replacementList)) {
        return $text;
    }
    $wordList = explode(' ', $text);
    $result = [];

    foreach ($wordList as $word) {
        $result[] = in_array($word, $replacementList) ? '$#%!' : $word;
    }

    return implode(' ', $result);
}

function buildDefinitionList(array $defenition_list): string
{
    $parts = [];
    foreach ($defenition_list as $defenition) {
        $parts[] = "<dt>{$defenition[0]}</dt>";
        $parts[] = "<dd>{$defenition[1]}</dd>";
    }

    $inner = implode('', $parts);
    $result = "<dl>{$inner}</dl>";

    return $result;
}

function getSuperSeriesWinner(array $scores): string
{
    $total = 0;
    foreach ($scores as $score) {
        $total += $score[0] <=> $score[1];
        print_r($total);
        print_r("\n");
    }
    if ($total > 0) {
        return 'canada';
    }
    elseif ($total < 0) {
        return 'ussr';
    }
    return null;
}

function getTotalAmount(array $wallet, string $currency)
{
    if (empty($wallet)) {
        return 0;
    }
    $total = 0;
    foreach ($wallet as $banknote) {
        $currencyPos = strpos($banknote, $currency);
        if ($currencyPos === false) {
            continue;
        }
        $value = (int)substr($banknote, $currencyPos + strlen($currency) + 1);
        $total += $value;
    }
    return $total;
}

function getSameParity(array $numbers)
{
    if (empty($numbers)) {
        return [];
    }
    $result = [];
    $firstItem = $numbers[0];
    foreach ($numbers as $number) {
        if ($firstItem % 2 === $number % 2) {
            $result[] = $number;
        }
    }
    return $result;
}
// END
