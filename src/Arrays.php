<?php

namespace App\Arrays;

use function Funct\Collection\tail;
use function Funct\Strings\length;

//которая принимает на вход имя сайта и возвращает информацию о нем:
function getDomainInfo(string $url)
{
    if ($url === '') {
        return [];
    }
    $scheme = [];
    if (substr($url, 0, 8) === 'https://') {
        $scheme = 'https';
    } else {
        $scheme = 'http';
    };
    $name = str_replace("{$scheme}://", '', $url);

    return ['scheme' => $scheme, 'name' => $name];
}

function getDomainInfo1(string $url)
{
    if ($url === '') {
        return [];
    }
    $schemeList = ["https", "http"];

    foreach ($schemeList as $scheme) {
        $schemeLen = strlen($scheme);
        if (substr($url, 0, $schemeLen) === $scheme) {
            return ['scheme' => $scheme, 'name' => substr($url, $schemeLen + 3)];
        }
    }
    return ['scheme' => 'http', name => $url];
}

/* извлекает из переданного массива все элементы по указанным ключам и возвращает новый массив. Аргументы:

    Исходный массив
    Массив ключей, по которым должны быть выбраны элементы (ключ и значение) из исходного массива,
    и на основе выбранных данных сформирован новый массив
 */
function pick(array $data, array $keyList)
{
    $result = [];
    foreach ($keyList as $key) {
        if (array_key_exists($key, $data)) {
            $result[$key] = $data[$key];
        }
    }
    return $result;
}

/* принимает на вход список пользователей, извлекает их имена,
сортирует и возвращает отсортированный список имен.
*/
function getSortedNames(array $users)
{
    $result = [];
    foreach ($users as ['name' => $name]) {
        $result[] = $name;
    }
    sort($result);
    return $result;
}

function getIn(array $data, array $keyList)
{
    $inner = $data;
    foreach ($keyList as $key) {
        if (!isset($inner[$key])) {
            return null;
        }
        $inner = $inner[$key];
    }
    return $inner;
}

function countWords(string $sentence)
{
    if ($sentence === '') {
        return [];
    }
    $wordList = explode(' ', $sentence);
    $lcWordList = [];
    foreach ($wordList as $word) {
        $lcWordList[] = mb_strtolower($word);
    }

    $result = [];
    foreach ($lcWordList as $lcWord) {
        if (array_key_exists($lcWord, $result)) {
            $result[$lcWord] += 1;
        } else {
            $result[$lcWord] = 1;
        }
    }
    return $result;
}

/* Принимает двумерный массив (матрицу) и возвращает массив, изменённый таким образом,
 что правая половина матрицы становится зеркальной копией левой половины,
 симметричной относительно вертикальной оси матрицы. Для простоты условимся, что матрица
 всегда имеет чётное количество столбцов и количество столбцов всегда равно количеству строк.
 [11, 12, 13, 14],
 [21, 22, 23, 24],
 [31, 32, 33, 34],
 [41, 42, 43, 44],*/
// → [
//     [11, 12, 12, 11],
//     [21, 22, 22, 21],
//     [31, 32, 32, 31],
//     [41, 42, 42, 41],
//   ]
function getMirrorMatrix(array $matrix)
{
    $result = [];
    $length = count($matrix);
    foreach ($matrix as $row) {
        $resultRow = [];
        for ($i = 0; $i < $length; $i++) {
            if ($i < $length / 2) {
                $resultRow[$i] = $row[$i];
            } else {
                $resultRow[$i] = $row[$length - 1 - $i];
            }
            //$resultRow[$i] = $row[$i];
        }
        //$result[] = [...$resultRow, ...array_reverse($resultRow)];
        $result[] = $resultRow;
    }
    return $result;
}

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
    $lenght2 = count($arr2);

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
    for ($i = 0, $length = strlen($expression); $i < $length; $i++) {
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
        for ($i = 0; $i < $size - 1; $i++) {
            if ($arr[$i] > $arr[$i + 1]) {
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
        if (!in_array($str[$i], $uniqueChars)) {
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
    foreach ($first as $item) {
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
    if ($text === '' || empty($replacementList)) {
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
    } elseif ($total < 0) {
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

function findWhere(array $recordsList, array $filtersList)
{
    $result = array_filter($recordsList, function ($record) use ($filtersList) {
        $find = true;
        foreach ($filtersList as $key => $value) {
            if ($record[$key] != $value) {
                $find = false;
            }
        }
        return $find;
    });
    return $result;
    //return null;
}

function calcInPolishNotation(array $expression)
{
    $operatorList = ['+', '-', '*', '/'];
    $stack = [];

    foreach ($expression as $value) {
        if (!in_array($value, $operatorList)) {
            array_push($stack, $value);
            continue;
        }

        $b = array_pop($stack);
        $a = array_pop($stack);
        array_push($stack, calculate($value, $a, $b));
    }

    return $stack[0];
}

function calculate(string $operator, $a, $b)
{
    switch ($operator) {
        case '+':
            return $a + $b;
            break;
        case '-':
            return $a - $b;
            break;
        case '*':
            return $a * $b;
            break;
        case '/':
            return $a / $b;
            break;
    }
}

function buildSnailPath(array $matrix)
{
    $result = [];
    while(count($matrix) > 1) {
        [$head] = $matrix;
        $tail = array_slice($matrix, 1);
        $result = array_merge($result, $head);
        $matrix = rotateLeft($tail);
    }
    
    return array_merge($result, ...$matrix);
}

function rotateLeft(array $matrix)
{
    if (empty($matrix)) {
        return [];
    }
    $conuntOfRows = count($matrix);
    $countOfColumns = count($matrix[0]);

    $result = array_fill(0, $countOfColumns, array_fill(0, $conuntOfRows, 0));
    for ($i = 0; $i < $conuntOfRows; $i++) {
        for ($j = 0; $j < $countOfColumns; $j++) {
            $result[$countOfColumns - 1 - $j][$i] = $matrix[$i][$j];
        }
    }

    return $result;
}

/* Возвращает указанную строку треугольника паскаля в виде массива */
function generate(int $numOfTheRow)
{
    $prevRow = [1];

    for ($row = 1; $row <= $numOfTheRow; $row++) {
        $currRow = [];
        for ($i = 0; $i <= $row; $i++) {
            $first = $prevRow[$i - 1] ?? 0;
            $second = $prevRow[$i] ?? 0;

            $currRow[] = $first + $second;
        }
        $prevRow = $currRow;
    }
    return $prevRow;
}