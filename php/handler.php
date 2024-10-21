<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/php/database.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/user_work.php';

header('Content-Type: application/json');

class Handler
{
	/**
	 * Обрабатывает регистрацию пользователя.
	 *
	 * @param UserWork $user
	 * @return void
	 */
	private static function registrationHandler(UserWork $user): void
	{
		$username = $_POST['username'] ?? '';
		$password = $_POST['password'] ?? '';
		$errorMessage = $user->validate($username, $password);

		if ($errorMessage)
		{
			echo json_encode(['status' => 'error', 'message' => $errorMessage]);
			exit;
		}

		$message = $user->register($username, $password);
		echo json_encode(['status' => 'success', 'message' => $message]);
	}

	/**
	 * Основной метод для обработки регистрации.
	 *
	 * @param UserWork $user
	 * @return void
	 */
	public static function getHandler(UserWork $user): void
	{
		self::registrationHandler($user);
	}
}

$db = new Database('MySQL-8.2', 'onlybase', 'root', '');
$user = new UserWork($db);
Handler::getHandler($user);
?>
