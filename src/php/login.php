<?php
include __DIR__ . '/scripts/login-mysql.php';
include __DIR__ . '/objects/User.php';
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/password-btn.css">
    <?php include_once __DIR__ . '/html-snippets/icons.html' ?>
    <title>Logowanie</title>
</head>
<body>

<?php include_once __DIR__ . '/html-snippets/header-logged.html'; ?>

<div class="content">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label for="email">Adres e-mail</label>
    <input type="email" name="email">
    <label for="passphrase">Hasło</label>
    <div class="password-container">
        <input type="password" name="passphrase" id="passphrase" class="password-input">
        <button type="button" class="show-password-btn">🔒</button>
    </div>
    <button type="submit">Zaloguj się</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = new User($conn, null);
        $email = $conn->real_escape_string($_POST['email']);
        $passphrase = $conn->real_escape_string($_POST['passphrase']);
        

        
        if ($user->verifyData($email, $passphrase)) {
            $_SESSION['userId'] = $user->getUserId($email);
            setcookie('id', $_SESSION['userId'], time() + (86400 * 30),'/');
            header('Location: /dashboard.php');
        } else {
            echo "Podano nieprawidłowe dane";
        }
    }

    ?>

<script src="/js/showPassword.js"></script>
</div>
    
</body>
</html>