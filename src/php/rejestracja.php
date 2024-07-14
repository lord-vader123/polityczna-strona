<?php
include_once '/php/login-mysql.php';
include_once '/php/obiekty/Uzytkownik.php';
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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="imie">Imię</label>
            <input type="text" name="imie">
            <label for="nazwisko">Nazwisko</label>
            <input type="text" name="nazwisko">
            <label for="login">Login/Mail</label>
            <input type="email" name="login">
            <label for="haslo">Hasło</label>
            <input type="password" name="haslo">
            <input type="submit" value="Zarejestruj się">
            <div id="blad"></div>
            <?php
            $uzytkownik = new Uzytkownik(NULL, $conn);
            var_dump($uzytkownik);

            $uzytkownik->setImie($_POST['imie']);
            $uzytkownik->setNazwisko($_POST['nazwisko']);
            $uzytkownik->setLogin($_POST['login']);
            $uzytkownik->setHaslo($_POST['haslo']);
            
            $uzytkownik.wyslijDoBazyDanych();
            
            ?>
        </form>
    </div>
    
    <script src="/js/weryfikacja-rejestracja.js"></script>
</body>
</html>