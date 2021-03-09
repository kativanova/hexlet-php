<?php

namespace App\Url;

function make($url)
{
    $data = parse_url($url);

    $query = [];
    if (isset($data['query'])) {
        parse_str($data['query'], $query);
    }

    $data['queryParams'] = $query;

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
        unset($url['queryParams'][$key]);
    } else {
        $url['queryParams'][$key] = $value;
    }
}

function getQueryParam(array &$url, $key, $default = null)
{
    return $url['queryParams'][$key] ?? $default;
}

function toString(array $url)
{
    $queryStr = http_build_query($url['queryParams']);
    $fullQueryStr = $queryStr ? "?{$queryStr}" : "";

    return "{$url['scheme']}://{$url['host']}{$url['path']}{$fullQueryStr}";
}
