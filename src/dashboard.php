<?php
include __DIR__ . '/php/scripts/login-mysql.php';
include __DIR__ . '/php/objects/User.php';
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header('Location: /index.php');
}
setcookie('id', $userId, time() + (86400 * 30),'/');
$user = new User($conn, (int) $userId);

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Strona polityczna - <?php echo "Nazwa użytkownika" ?> </title>
</head>
<body>

    <?php include_once __DIR__ . '/php/html-snippets/header.php'; ?>
    
    <div class="content">
        <?php

        ?>
    </div>

    
</body>
</html>