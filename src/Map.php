<?php

namespace App\Map;

//создаёт новый словарь
function make()
{
    return [];
}

/* устанавливает в словарь значение по ключу. Работает и для создания и для изменения.
Функция возвращает true, если удалось установить значение.
При возникновении коллизии, функция никак не меняет словарь и возвращает false. */
function set(array &$map, $key, $value)
{
    $index = getIndex($key);
    if (isset($map[$index]) && hasCollisions($map, $key)) {
        return false;
    }
    $map[$index] = [$key, $value];
}

/* читает в словаре значение по ключу и возвращает его. Параметр $defaultValue — значение, которое функция возвращает,
если в словаре нет ключа (по умолчанию равно null).
При возникновении коллизии функция также возвращает значение по умолчанию. */
function get($map, $key, $defaultValue = null)
{
    $index = getIndex($key);
    if (!isset($map[$index]) || hasCollisions($map, $key)) {
        return $defaultValue;
    }
    return $map[$index][1];
}

function getIndex(string $key)
{
    return crc32($key) % 1000;
}

function hasCollisions(array $map, $key)
{
    $index = getIndex($key);
    [$currentKey] = $map[$index];
    return $currentKey !== $key;
}
