<?php

namespace App\Func;

use Funct\Collection;

use function Funct\Collection\flatten;

function sayPrimeOrNot(int $num): void
{
    if (isPrime($num)) {
        print_r('yes');
    } else {
        print_r('no');
    }
}

function isPrime(int $num): bool
{
    for ($i = 2; $i <= $num / 2; $i++) {
        if ($num % $i === 0) {
            return false;
        }
    }
    return true;
}

function show(...$arguments)
{
    print_r($arguments);
}

function union($first, ...$rest)
{
    // BEGIN (write your solution here)
    return array_values(array_unique(array_merge($first, ...$rest)));

    // END
}

function takeOldest(array $users, int $count)
{
    usort(
        $users,
        function ($a, $b) {
            $data1 = strtotime($a['birthday']);
            $data2 = strtotime($b['birthday']);
            return $data1 <=> $data2;
        }
    );
    //return firstN($users, $count);
    return $users;
}


function getChildren(array $users)
{
    $children = array_map(fn ($user) => $user['children'], $users);
    return flatten($children);
}

function getGirlFriends(array $users)
{
    $friends = flatten(array_map(fn ($user) => $user['friends'], $users));
    return array_values(array_filter($friends, fn ($friend) => $friend['gender'] === 'female'));
}

function getMenCountByYear(array $users)
{
    $manList = array_filter($users, fn ($user) => $user['gender'] === 'male');
    $manBirthYears = array_map(fn ($user) => date('Y', strtotime(($user['birthday']))), $manList);
    return array_reduce($manBirthYears, function ($acc, $year) {
        $acc[$year] = ($acc[$year] ?? 0) + 1;
        return $acc;
    }, []);
    /*     return array_reduce($users, function ($acc, $user) {
        if ($user['gender'] === 'male') {
            $year = date('Y', strtotime($user['birthday']));
            $acc[$year] = ($acc[$year] ?? 0) + 1;
        }
        return $acc;
    }, $menByYears); */
}

function getManWithLeastFriends(array $users)
{
    if (empty($users)) {
        return null;
    }
    return Collection\minValue($users, function ($user) {
        return count($user['friends']);
    });
}

function without(array $items, ...$valuesList)
{
    $filtered = array_filter($items, function ($item) use ($valuesList) {
        return !in_array($item, $valuesList);
    });
    // Сбрасываем ключи
    return array_values($filtered);
}

function duplicateEach(array $image)
{
    //return array_map(fn($item) => [$item, $item], $image);
    return Collection\flatten(array_map(fn($item) => [$item, $item], $image));
}

function enlargeArrayImage(array $image)
{
    $horizonallyStretched = array_map(fn($col) => duplicateEach($col), $image);
    return duplicateEach($horizonallyStretched);
}

function print_array(array $arr)
{
    foreach ($arr as $row) {
        foreach ($row as $item) {
            echo $item;
        }
        echo PHP_EOL;
    }
}
