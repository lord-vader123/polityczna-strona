<?php
session_start();
include __DIR__ . '/php/scripts/login-mysql.php';
include __DIR__ . '/php/objects/User.php';
$id = User::getUserIdByWhatever($conn);
if (!$id) {
    header('Location: /index.php');
    exit();
}

$user = new User($conn, (int) $id);
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