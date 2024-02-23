<?php 

require "bootstrap.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode('/', $path);

$resource = $parts[3];

$id = $parts[4] ?? null;

if ($resource != 'tasks') {	
	http_response_code(404);
	exit;
}

$controller = new TaskController();

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
