<?php
include __DIR__ . '/php/scripts/login-mysql.php';
include __DIR__ . '/php/objects/User.php';
session_start();
User::isCoockieSet();
$_SESSION['userId'] = $_SESSION['userId'] ?? $_COOKIE['id'];
$userId = $_SESSION['userId'];
$user = new User($conn, (int) $userId);
$userData = $user->getDataArray();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <?php include_once __DIR__ . '/php/html-snippets/icons.html' ?>
    <title>Strona polityczna - <?php echo $userData['name'] ?> </title>
</head>
<body>

    <?php include_once __DIR__ . '/php/html-snippets/header-logged.html'; ?>
    
    <div class="content">

    </div>

    
</body>
</html>