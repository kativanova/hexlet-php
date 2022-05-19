<?php

namespace App\Solution;

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
