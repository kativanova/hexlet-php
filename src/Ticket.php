<?php

namespace Hexlet\Php\Ticket;

function stringSum(string $str): int
{
    $sum = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $sum += (int) $str[$i];
    }
    return $sum;
}
function isHappy(string $ticket): bool
{
    $subStrLength = strlen($ticket) / 2;
    $subStr1 = substr($ticket, 0, $subStrLength);
    $subStr2 = substr($ticket, $subStrLength);
    return stringSum($subStr1) === stringSum($subStr2);
}
