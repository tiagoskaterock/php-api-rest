<?php

class TaskGateway {

	private PDO $conn;

	function __construct(Database $database) {
		$this->conn = $database->getConnection();
	}

	function getAll() : array {
		$sql = "SELECT * FROM tasks ORDER BY NAME";
		$stmt = $this->conn->query($sql);

		$data = [];

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$row['is_completed'] = (bool) $row['is_completed'];
			$data[] = $row;
		}

		return $data;
	}

	function getOne(string $id) : array | false {
		$sql = "SELECT * FROM tasks WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($data !== false) {
			$data['is_completed'] = (bool) $data['is_completed'];
		}

		return $data;
	}

}
