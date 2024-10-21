<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h2 class="text-center">Регистрация</h2>
            <form id="registration-form">
                <div class="form-group">
                    <label for="username">Логин</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Зарегистрироваться</button>
            </form>
            <div id="response" class="mt-3"></div>
        </div>
    </div>
    <a href="watch.php" class="btn btn-danger mt-3">Посмотреть зарегистрированных пользователей</a>
</div>
<script>
    document.getElementById('registration-form').addEventListener('submit', function (e)
    {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('handler.php',
            {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data =>
            {
                document.getElementById('response').innerText = data.message;
            })
            .catch(error => console.error('Ошибка:', error));
    });
</script>
</body>
</html>