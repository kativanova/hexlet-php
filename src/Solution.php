<?php

namespace Hexlet\Php\Solution;

/* Сравнивает два ассоциативных массива и возвращает результат сравнения в виде ассоциативного массива.
Ключами результирующего массива будут все ключи из двух входящих массивов,
а значением строка с описанием отличий => added, deleted, changed или unchanged.
['one' => 'eon', 'two' => 'two', 'four' => true],
['two' => 'own', 'zero' => 4, 'four' => true]
*/
function genDiff(array $first, array $second)
{
    $keyList = array_unique(array_merge(array_keys($first), array_keys($second)));
    $result = [];
    foreach ($keyList as $key) {
        if (!array_key_exists($key, $first)) {
            $result[$key] = 'added';
        } elseif (!array_key_exists($key, $second)) {
            $result[$key] = 'deleted';
        } elseif ($first[$key] === $second[$key]) {
            $result[$key] = 'unchanged';
        } else {
            $result[$key] = 'changed';
        }
    }
    return $result;
}

//Принимает две матрицы и возвращает новую матрицу — результат их произведения
function multiply(array $firstMatrix, array $secondMatrix)
{
    $result = [];
    for ($i = 0, $rowFirst = count($firstMatrix); $i < $rowFirst; $i++) {
        $resCol = [];
        for ($k = 0, $colSecond = count($secondMatrix[0]); $k < $colSecond; $k++) {
            $value = 0;
            for ($j = 0, $colFirst = count($firstMatrix[$i]); $j < $colFirst; $j++) {
                $value += $firstMatrix[$i][$j] * $secondMatrix[$j][$k];
            }
            $resCol[] = $value;
        }
        $result[] = $resCol;
    }
    return $result;
}

/* Принимает на вход поле боя в виде квадратного двумерного массива из нулей и единиц.
 Ноль — пустая ячейка, единица — часть корабля.
 Функция должна вернуть количество кораблей на поле боя.
 */
function calcShipsCount(array $field)
{
    if (!isValidField($field)) {
        return 0;
    }
    $sum = 0;
    for ($i = 0, $count = count($field); $i < $count; $i++) {
        for ($j = 0; $j < $count; $j++) {
            if ($field[$i][$j]) {
                if (array_key_exists($j + 1, $field[$i]) && $field[$i][$j + 1]) {
                    //horisontal ship
                    $n = 1;
                    while (array_key_exists($j + $n, $field[$i]) && $field[$i][$j + $n]) {
                        $field[$i][$j + $n] = 0;
                        $n++;
                    }
                } elseif (array_key_exists($i + 1, $field) && $field[$i + 1][$j]) {
                    //vertical ship
                    $n = 1;
                    while (array_key_exists($i + $n, $field) && $field[$i + $n][$j]) {
                        $field[$i + $n][$j] = 0;
                        $n++;
                    }
                }
                //one-deck ship or already counted longer ships
                $field[$i][$j] = 0;
                $sum++;
            }
        }
    }
    return $sum;
}

/* Корабли не должны соприкасаться друг с другом. Функция проверяет расстановку кораблей на корректность.
 print_r(isValidField([
 [0, 1, 0, 0],
 [1, 0, 0, 1],
 [0, 0, 0, 0],
 [0, 1, 1, 1],
 ])
 ); // false
 */
function isValidField(array $field): bool
{
    for ($i = 0, $count = count($field); $i < $count; $i++) {
        for ($j = 0; $j < $count; $j++) {
            if ($field[$i][$j]) {
                //$top_left = $field[$i - 1][$j - 1] ?? 0; //they are already checked as we go from left to right
                $top_right = $field[$i + 1][$j - 1] ?? 0;
                //$bottom_left = $field[$i - 1][$j + 1] ?? 0;
                $bottom_right = $field[$i + 1][$j + 1] ?? 0;
                if ($top_right || $bottom_right) {
                    return false;
                }
            }
        }
    }
    return true;
}

/* Сравнивает переданные версии version1 и version2.
 Если version1 > version2, то функция должна вернуть 1,
 если version1 < version2, то - -1,isValidField()
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
