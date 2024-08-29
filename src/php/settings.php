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

<?php include_once __DIR__ . '/php/html-snippets/header-logged.html'; ?>

<div class="content">

<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

<p>Wypełnij dane które pragniesz zmienić</p>
<label for="name">Imię</label>
<input type="text" id="name" name="name">
<label for="surname">Nazwisko</label>
<input type="text" id="surname" name="surname">
<label for="email">Adres e-mail</label>
<input type="email" id="email" name="email">
<label for="passphrase">Hasło</label>
<input type="password" id="passphrase" name="passphrase">
<button type="submit">Zatwierdź</button>

</form>

<?php

$data = array(
    'name' => $conn->real_escape_string(trim($_POST['name']) ?? null),
    'surname' => $conn->real_escape_string(trim($_POST['surname']) ?? null),
    'login' => $conn->real_escape_string(trim($_POST['email']) ?? null),
    'passphrase' => $conn->real_escape_string(trim($_POST['passphrase']) ?? null),
);


try {
    $user->updateData($data);
    echo "Zaktualizowano Twoje dane!";
} catch (Exception $e) {
    echo "Nie zmieniono żadnych danych.";
}
?>

</div>
    
</body>
</html>