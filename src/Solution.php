<?php

namespace Hexlet\Php\Solution;

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
