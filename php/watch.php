<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php/database.php';

$db = new Database('MySQL-8.2', 'onlybase', 'root', '');
$pdo = $db->getConnection();

$sql = "SELECT id, username FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Список пользователей</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
	<h2 class="text-center">Список пользователей</h2>
	<table class="table table-bordered mt-3">
		<thead>
		<tr>
            <th>ID</th>
			<th>Логин</th>
		</tr>
		</thead>
		<tbody>
		<?php if (count($users) > 0): ?>
			<?php foreach ($users as $user): ?>
				<tr>
                    <td><?= htmlspecialchars($user['id'])?></td>
					<td><?= htmlspecialchars($user['username']); ?></td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="1" class="text-center">Пользователи не найдены</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
	<a href="index.php" class="btn btn-secondary mt-3">Назад к регистрации</a>
</div>
</body>
</html>

