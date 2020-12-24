<?php

namespace Hexlet\Php\Solution;

/* Сравнивает переданные версии version1 и version2.
Если version1 > version2, то функция должна вернуть 1,
если version1 < version2, то - -1,
если же version1 = version2, то - 0. */
function compareVersion(string $version1, string $version2)
{
    $first = explode('.', $version1);
    $second = explode('.', $version2);
    
    print_r($first);
    print_r($second);
    
    for ($i = 0; $i < 2; $i++) {
        if ($first[$i] > $second[$i]) {
            return 1;
        } elseif ($first[$i] < $second[$i]) {
            return -1;
        }
    }
    return 0;
}

/* Принимает на вход массив и число, задающее размер чанка (куска).
Функция должна вернуть массив, состоящий из чанков указанной размерности. */
function getChunked(array $arr, int $size)
{
    $result = [];
    for ($i = 0, $maxIndex = count($arr); $i < $maxIndex;) {
        $item = [];
        for ($j = 0; $j < $size && $i < $maxIndex; $j++) {
            $item[] = $arr[$i];
            $i++;
        }
        $result[] = $item;
    }
    
    return $result;
}

/* Принимает на вход массив интервалов и возвращает сумму всех длин интервалов.
В данной задаче используются только интервалы целых чисел от -100 до 100 , которые представлены в виде массива.
Первое значение интервала всегда будет меньше, чем второе значение.
Например, длина интервала [-100, 0] равна 100, а длина интервала [5, 5] равна 0.
Пересекающиеся интервалы должны учитываться только один раз.
echo sumIntervals([
    [1, 5],
    [-10, 19],
    [1, 7],
    [16, 100],
    [5, 11]
    ]); // 110 */
    
function sumIntervals(array $intervalList)
{
    $wholeSegment = array_fill_keys(range(-100, 100), 0);
    foreach ($intervalList as [$start, $end]) {
        for ($i = $start; $i < $end; $i++) {
            $segment[$i] = 1;
        }
    }
    //print_r($wholeSegment);
    return array_sum($wholeSegment);
}

function fizzBuzz(int $begin, int $end)
{
    if ($begin > $end) {
        return;
    }
    for ($i = $begin; $i <= $end; $i++) {
        if ($i % 15 === 0) {
            print_r('FizzBuzz');
        } elseif ($i % 5 === 0) {
            print_r('Buzz');
        } elseif ($i % 3 === 0) {
            print_r('Fizz');
        } else {
            print_r($i);
        }
        print_r(' ');
    }
    print_r("\n");
}
