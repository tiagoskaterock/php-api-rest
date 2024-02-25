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

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

$task_gateway = new TaskGateway($database);

$controller = new TaskController($task_gateway);

$database->getConnection();

$controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
