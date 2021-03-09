<?php

namespace App\Url;

function make($url)
{
    $urlParts = parse_url($url);
    $data['scheme'] = $urlParts['scheme'];
    $data['host'] = $urlParts['host'];
    $data['path'] = $urlParts['path'];

    $query = [];
    if (isset($urlParts['query'])) {
        parse_str($urlParts['query'], $query);
    }

    $data['query'] = $query;

    return $data;
}

function setScheme(array &$url, string $scheme)
{
    $url['scheme'] = $scheme;
}

function getScheme(array $url)
{
    return $url['scheme'];
}

function setHost(array &$url, string $host)
{
    $url['host'] = $host;
}

function getHost(array $url)
{
    return $url['host'];
}

function setPath(array &$url, $path)
{
    $url['path'] = $path;
}

function getPath(array $url)
{
    return $url['path'];
}

function setQueryParam(array &$url, $key, $value)
{
    if ($value === null) {
        unset($url['query'][$key]);
    } else {
        $url['query'][$key] = $value;
    }
}

function getQueryParam(array &$url, $key, $default = null)
{
    if (array_key_exists($key, $url['query'])) {
        return $url['query'][$key];
    }
    return $default;
}

function toString(array $url)
{
    $queryStr = getQueryString($url['query']);
    print_r("{$url['scheme']}://{$url['host']}{$url['path']}{$queryStr}");
    echo PHP_EOL;
    return "{$url['scheme']}://{$url['host']}{$url['path']}{$queryStr}";
}

function getQueryString(array $params)
{
    $result = "?";
    foreach ($params as $key => $value) {
        $result .= "{$key}={$value}&";
    }
    return substr($result, 0, strlen($result) - 1);
}
