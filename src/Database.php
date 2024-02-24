<?php

class Database {

	function __construct (
		private string $hostname,
		private string $database,
		private string $username,
		private string $password,
	) {
		$this->newConnection();
	}	


	private function newConnection() {
		$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
		$dotenv->load();

		$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);

		$database->getConnection();
	}


	private function getConnection() : PDO {
		$dsn = "mysql:host={$this->hostname};dbname={$this->database};charset=utf8";

		return new PDO($dsn, $this->username, $this->password, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]);
	}
}