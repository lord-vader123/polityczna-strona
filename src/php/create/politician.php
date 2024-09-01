<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once __DIR__ . '/../objects/Table.php';
include_once __DIR__ . '/../objects/Politician.php';
include_once __DIR__ . '/../objects/ImageHandler.php';
include_once __DIR__ . '/../scripts/login-mysql.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once __DIR__ . '/../html-snippets/icons.html'; ?>
    <link rel="stylesheet" href="/css/style.css">
    <title>Dodaj polityka</title>
</head>
<body>

<?php include_once __DIR__ . '/../html-snippets/header-logged.html'; ?> 

<div class="content">

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <label for="name">Imię</label>
        <input type="text" name="name" id="name">

        <label for="surname">Nazwisko</label>
        <input type="text" name="surname" id="surname">

        <label for="party">Partia</label>
        <input list="party" name="party" >


        <label for="committee">Komitet wyborczy</label>
        <input list="committee" name="committee">

        <label for="portrait">Portret polityka</label>
        <input type="file" name="portrait" id="portrait">

        <button type="submit">Zatwierdź</button>

        <datalist id="party">
            <?php
            $parties = new Table($conn, "party");
            $data = $parties->getTableArray();
            foreach ($data as $row) {
                echo '<option value="' . $row['full_name'] . '">';
            }
            unset($parties);
            ?>
        </datalist>


        <datalist id="committee">            
            <?php
            $parties = new Table($conn, "committee");
            $data = $parties->getTableArray();
            foreach ($data as $row) {
                echo '<option value="' . $row['name'] . '">';
            }
            unset($parties);
            ?>
        </datalist>


    </form>

</div>
    
</body>
</html>