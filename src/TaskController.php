<?php

class TaskController {

	function __construct(private TaskGateway $gateway) {

	}


	function processRequest(string $method, ?string $id) : void {
		if ($id === null) {
			if($method == 'GET') {
				echo json_encode($this->gateway->getAll());
			}
			elseif($method == 'POST') {
				echo 'create';
			}
			else {
				$this->respondMethodNotAllowed("GET, POST");
			}
		}
		else {
			switch ($method) {
				case 'GET':
					echo json_encode($this->gateway->getOne($id));
					break;

				case 'PATCH':
					echo 'update ' . $id;
					break;

				case 'DELETE':
					echo 'delete ' . $id;
					break;
				
				default:
					$this->respondMethodNotAllowed("GET, PATCH, DELETE");
			}
		}
	}


	private function respondMethodNotAllowed(string $allowed_methods) : void {
		http_response_code(405);
		header("Allow: $allowed_methods");
	}

}
