<?php
include __DIR__ . '/../scripts/login-mysql.php';
include __DIR__ . '/../objects/ImageHandler.php';
include __DIR__ . '/../objects/Party.php';
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . "../html-snippets/icons.html"; ?>
    <link rel="stylesheet" href="/css/style.css">
    <title>Stwórz partię</title>
</head>

<body>

    <?php include __DIR__ . '/../html-snippets/header-logged.html'; ?>

    <div class="content">


    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
        <label for="long_name">Pełna nazwa</label>        
        <input type="text" name="long_name" id="long_name">
        <label for="short_name">Skrót nazwy</label>
        <input type="text" name="short_name" id="short_name">
        <label for="logo">Logo partii (nie większe niż 1gb)</label>
        <input type="file" name="logo" id="logo">
        <button type="submit">Zatwierdź</button>
    </form>

    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {
        $imageHandler = new ImageHandler('party', $_FILES['logo']); 
        $imageHandler->saveFile();
        
        $data = [
            'long_name' => $conn->real_escape_string($_POST['long_name']),
            'short_name' => $conn->real_escape_string($_POST['short_name']),
            'logo' => $imageHandler->getFinalPath(),
        ];
        
        try {
            $party = new Party($conn, null);
            $party->setData($data);
            $party->sendToDb();
        } catch (Exception $e) {
            echo 'Error: '. $e->getMessage() .'<br>';
        }
    } else {
        echo "Błąd";
    }
    ?>


    </div>
</body>

</html>