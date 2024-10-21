<?php

class UserWork
{
	/**
	 * @var PDO Подключение к базе данных.
	 */
	private PDO $pdo;

	/**
	 * UserWork constructor.
	 *
	 * @param Database $database Объект базы данных.
	 */
	public function __construct(Database $database)
	{
		$this->pdo = $database->getConnection();
	}

	/**
	 * Валидация введенных данных пользователя.
	 *
	 * Проверяет, соответствуют ли логин и пароль требованиям.
	 *
	 * @param string $username Логин пользователя.
	 * @param string $password Пароль пользователя.
	 * @return string|null Сообщение об ошибке или null, если ошибок нет.
	 */
	public function validate(string $username, string $password): ?string
	{
		if (strlen($username) < 5)
		{
			return 'Логин должен быть не менее 5 символов.';
		}
		if (strlen($password) < 8)
		{
			return 'Пароль должен быть не менее 8 символов.';
		}
		return null;
	}

	/**
	 * Регистрация нового пользователя.
	 *
	 * Хэширует пароль и сохраняет пользователя в базе данных.
	 *
	 * @param string $username Логин пользователя.
	 * @param string $password Пароль пользователя.
	 * @return string Сообщение о результате регистрации.
	 */
	public function register(string $username, string $password): string
	{
		$hash = password_hash($password, PASSWORD_BCRYPT);

		$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
		$stmt = $this->pdo->prepare($sql);

		try
		{
			$stmt->execute(['username' => $username, 'password' => $hash]);
			return 'Регистрация успешна!';
		}
		catch (Exception $e)
		{
			return 'Ошибка при регистрации: ' . $e->getMessage();
		}
	}
}
