<?php
include __DIR__ . '/scripts/login-mysql.php';
include __DIR__ . '/objects/User.php';
User::isCoockieSet();
$user = new User($conn, $_COOKIE['id']);
$userData = $user->getDataArray();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/html-snippets/icons.html'; ?>
    <link rel="stylesheet" href="/css/style.css">
    <title>Ustawienia użytkownika <?php echo $userData['name']; ?></title>
</head>
<body>

<?php include_once __DIR__ . '/html-snippets/header.html'; ?>

<div class="content">

<form action="<? htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

<p>Wypełnij dane które pragniesz zmienić</p>
<label for="name">Imię</label>
<input type="text" id="name">
<label for="surname">Nazwisko</label>
<input type="text" id="surname">
<label for="email">Adres e-mail</label>
<input type="email" id="email">
<label for="passphrase">Hasło</label>
<input type="password" id="passphrase">
<button type="submit">Zatwierdź</button>

</form>

</div>
    
</body>
</html>