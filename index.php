<?php 

require "bootstrap.php";

set_exception_handler("ErrorHandler::handleException");

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode('/', $path);

$resource = $parts[3];

$id = $parts[4] ?? null;

if ($resource != 'tasks') {	
	http_response_code(404);
	exit;
}

header("Content-type: application/json; charset=UTF-8");

$database = new Database("localhost", "php_api", "tiago", "12345678");

$database->getConnection();

$controller = new TaskController();

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
