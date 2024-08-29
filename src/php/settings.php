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
    
</body>
</html>