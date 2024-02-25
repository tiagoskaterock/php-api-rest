<?php

class TaskGateway {

	private PDO $conn;

	function __construct(Database $database) {
		$this->conn = $database->getConnection();
	}

	function getAll() : array {
		$sql = "SELECT * FROM tasks ORDER BY NAME";
		$stmt = $this->conn->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}
