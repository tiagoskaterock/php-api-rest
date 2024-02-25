<?php

class TaskGateway {

	private PDO $conn;

	function __construct(Database $database) {
		$this->conn = $database->getConnection();
	}

}
