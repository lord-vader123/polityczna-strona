<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Logowanie</title>
</head>
<body>

<?php include __DIR__ . '/header.php'; ?>

<div class="content">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label for="email">Adres e-mail</label>
    <input type="email" name="email">
    <label for="passphrase">Hasło</label>
    <input type="password" name="passphrase">
    <button type="submit">Zaloguj się</button>
        
    </form>

</div>
    
</body>
</html>