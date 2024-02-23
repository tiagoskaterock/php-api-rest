<?php 

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$parts = explode('/', $path);

$resource = $parts[3];

$id = $parts[4] ?? null;

echo "\n" . $resource, ', ', $id . "\n";

echo 'Method: ' . $_SERVER['REQUEST_METHOD'] . "\n";

// echo "<h1>" . $resource . "</h1>";

if ($resource != 'tasks') {	
	// header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
	http_response_code(404);
	exit;
}
// else {
// 	echo 'bosta';
// }
