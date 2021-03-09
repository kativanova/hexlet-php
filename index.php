<?php
/**
 * This file is used for exprtimenting with composer
 */
require __DIR__ . '/vendor/autoload.php';

// Файл не включается на прямую
// Он загрузится автоматически благодаря автозагрузке
use App\Url;

$url = Url\make('https://hexlet.io/community');

Url\setScheme($url, 'http');
//Url\toString($url); // 'http://hexlet.io/community?q=low'

Url\setPath($url, '/404');
//Url\toString($url); // 'http://hexlet.io/404?q=low'

Url\setQueryParam($url, 'page', 5);
//Url\toString($url); // 'http://hexlet.io/404?q=low&page=5'

Url\setQueryParam($url, 'q', 'high');
//Url\toString($url); // 'http://hexlet.io/404?q=high&page=5'

Url\setQueryParam($url, 'qq', null);
Url\toString($url); // 'http://hexlet.io/404?page=5'