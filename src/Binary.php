<?php

namespace Hexlet\Php\Binary;

/**
 * Принимает на вход два бинарных числа (в виде строк) и возвращает их сумму.
 * Результат (вычисленная сумма) также бинарное число в виде строки.
 */
function binarySum(string $binaryNum1, string $binaryNum2): string
{
    $num1 = bindec($binaryNum1);
    $num2 = bindec($binaryNum2);

    return decbin($num1 + $num2);
}
