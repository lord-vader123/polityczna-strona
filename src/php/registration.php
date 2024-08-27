<?php
include __DIR__ . '/login-mysql.php';
include __DIR__ . '/objects/User.php';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <header>
        <a href="/index.php">Powrót</a>
    </header>

    <div class="content">
        <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="imie">Imię</label>
            <input type="text" name="name">
            <label for="nazwisko">Nazwisko</label>
            <input type="text" name="surname">
            <label for="login">Login/Mail</label>
            <input type="email" name="login">
            <label for="haslo">Hasło</label>
            <input type="password" name="passphrase">
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
                
                // wysłanie do bazy danych 
                $user->sendToDb();
                $conn->close();
            }

            ?>
    </div>
    
    <script src="/js/verify.js"></script>
</body>
</html>