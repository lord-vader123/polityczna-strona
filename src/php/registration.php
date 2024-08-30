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
    <title>Rejestracja</title>
    <?php include_once __DIR__ . '/html-snippets/icons.html' ?>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <?php include_once __DIR__ . '/html-snippets/header.html'; ?>

    <div class="content">
        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="imie">Imię</label>
            <input type="text" name="name" id="name">
            <label for="nazwisko">Nazwisko</label>
            <input type="text" name="surname" id=surname>
            <label for="login">Login/Mail</label>
            <input type="email" name="login" id=login>
            <label for="passphrase">Hasło</label>
            <input type="password" name="passphrase" id=passphrase>
            <label for="passphrase2">Powtórz hasło</label>
            <input type="password" name="passphrase2" id=passphrase2>
            <input type="submit" value="Zarejestruj się">
            <div id="error"></div>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'name' => $conn->real_escape_string($_POST['name']),
                'surname' => $conn->real_escape_string($_POST['surname']),
                'login' => $conn->real_escape_string($_POST['login']),
                'passphrase' => $conn->real_escape_string($_POST['passphrase']),
            );

            $user = new User($conn, null);
            $user->setData($data);

            if (!$user->checkLoginAvailability($data['login'])) {
                echo "Podany adres email jest już wykorzystany.";
                exit(1);
            }
        
            // wysłanie do bazy danych 
        
            if ($user->sendToDb()) {
                $_SESSION['userId'] = $user->getUserId();
                setcookie('id', $_SESSION['userId'], time() + (86400 * 30),'/');
                $conn->close();
                header('Location: /dashboard.php');
                exit();
            } else {
                echo "Coś poszło nie tak…";
            }
        }
        ?>
    </div>
    <script src="/js/verify.js"></script>

</body>

</html>