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

<?php include_once __DIR__ . '/html-snippets/header.html'; ?>

<div class="content">
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <label for="email">Adres e-mail</label>
    <input type="email" name="login">
    <label for="passphrase">Hasło</label>
    <div class="password-container">
        <input type="password" name="passphrase" id="passphrase" class="password-input">
        <button type="button" class="show-password-btn">🔒</button>
    </div>
    <label for="coockies">Nie wylogowuj mnie</label>
    <input type="checkbox" name="coockies" id="coockies">
    <button type="submit">Zaloguj się</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = new User($conn, null);
        $login = $conn->real_escape_string($_POST['login']);
        $passphrase = $conn->real_escape_string($_POST['passphrase']);
        

        
        if ($user->verifyData($login, $passphrase)) {
            if (isset($_POST['coockies'])) {
                setcookie('login', $login, time() + (86400 * 30),'/');
                setcookie('passphrase', $passphrase, time() + (86400 * 30),'/');
            }

            $_SESSION['login'] = $login;
            $_SESSION['passphrase'] = $passphrase;

            header('Location: /dashboard.php');
            exit();
        } else {
            echo "Podano nieprawidłowe dane";
        }
    }

    ?>

<script src="/js/showPassword.js"></script>
</div>
    
</body>
</html>