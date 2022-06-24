<?php

session_start();

require_once ('app/views/View.php');
require_once('config.php');

error_reporting(0);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', trim($uri, '/'));

$controller = !empty($segments[0]) ? $segments[0] : 'main';
$method = $_SERVER['REQUEST_METHOD'];
$action = !empty($segments[1]) ? $segments[1] : '';

$file = 'app/controllers/'.$controller.'Controller.php';

if (file_exists($file)) {
    require $file;
} else {
    new View('error');
}

function redirect(string $path)
{
    header('Location: '.$path);
    exit();
}