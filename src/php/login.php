<?php
include __DIR__ . '/login-mysql.php';
include __DIR__ . '/objects/User.php';
session_start();
?>
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

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = new User($conn, null);
        $email = $conn->real_escape_string($_POST['email']);
        $passphrase = $conn->real_escape_string($_POST['passphrase']);
        

        
        if ($user->verifyData($email, $passphrase)) {
            $_SESSION['userId'] = $user->getUserId($email);
            header('Location: /dashboard.php');
        } else {
            echo "Podano nieprawidłowe dane";
        }
    }

    ?>

</div>
    
</body>
</html>