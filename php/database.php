<?php

class Database
{
	private string $host;
	private string $db;
	private string $user;
	private string $pass;
	private PDO $pdo;

	public function __construct(string $host, string $db, string $user, string $pass)
	{
		$this->host = $host;
		$this->db = $db;
		$this->user = $user;
		$this->pass = $pass;

		$this->connect();
	}

	private function connect(): void
	{
		try
		{
			$this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
			die("Ошибка подключения: " . $e->getMessage());
		}
	}

	public function getConnection(): PDO
	{
		return $this->pdo;
	}
}
