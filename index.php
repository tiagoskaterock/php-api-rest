<?php 

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode('/', $path);

$resource = $parts['2'];

$id = $parts[3] ?? null;

echo $resource, ', ', $id;

echo $_SERVER['REQUEST_METHOD'];
