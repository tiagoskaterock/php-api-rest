<?php

class TaskController {

	function __construct(private TaskGateway $gateway) {

	}


	function processRequest(string $method, ?string $id) : void {
		if ($id === null) {

			// get all records
			if($method == 'GET') {
				echo json_encode($this->gateway->getAll());
			}

			// create
			elseif($method == 'POST') {
				$data = (array) json_decode(file_get_contents("php://input"), true);

				$errors = $this->getValidationErrors($data);

				if ( ! empty($errors)) {
					$this->respondUnprocessableEntity($errors);
					return;
				}

				$id = $this->gateway->create($data);
				$this->respondCreated($id);
			}
			else {
				$id = $this->respondMethodNotAllowed("GET, POST");
			}
		}
		else {

			$task = $this->gateway->getOne($id);

			if ($task === false) {
				$this->respondNotFound($id);
				return;
			}

			switch ($method) {

				// get single record
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


	private function respondUnprocessableEntity(array $errors) : void {
		http_response_code(422);
		echo json_encode(['errors' => $errors]);
	}


	private function respondMethodNotAllowed(string $allowed_methods) : void {
		http_response_code(405);
		header("Allow: $allowed_methods");
	}


	private function respondNotFound(string $id) : void {
		http_response_code(404);
		echo json_encode(["message" => "Task with id $id not found."]);
	}


	private function respondCreated(string $id) : void {
		http_response_code(201);
		echo json_encode(["message" => "Task Created", "id" => $id]);
	}


	function getValidationErrors(array $data) : array {

		$errors = [];

		if (empty($data['name'])) {
			$errors[] = 'name is required';
		}

		if( ! empty($data['priority'])) {
			if (filter_var($data['priority'], FILTER_VALIDATE_INT) === FALSE) {
				$errors[] = 'priority must be an integer';
			}
		}

		return $errors;
	}

}
