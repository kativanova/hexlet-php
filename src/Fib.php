<?php

namespace Hexlet\Php\Fib;

function fib(int $fibIndex): int {
    
    if ($fibIndex === 0) {
        return 0;
    }
    $fi1 = 1;
    $fi2 = 1;
    $fi = 0;
    
    for ($i = 2; $i < $fibIndex; $i++) {
        
        $fi = $fi1 + $fi2;
        
        $fi2 = $fi1;
        $fi1 = $fi;

    }

    return $fi1;
}