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
            <input list="party" name="party">


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
                    echo '<option value="' . $row['id'] . '">' . $row['full_name'] . '</option>';
                }
                unset($parties);
                ?>
            </datalist>


            <datalist id="committee">
                <?php
                $committees = new Table($conn, "committee");
                $data = $committees->getTableArray();
                foreach ($data as $row) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                unset($committees);
                ?>
            </datalist>
        </form>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['portrait']) && $_FILES['portrait']['error'] == UPLOAD_ERR_OK) {

        
            $imageHandler = new ImageHandler('politician', $_FILES['portrait']);
            $imageHandler->saveFile();
            $imagePath = $imageHandler->getFinalPath();
            
            $data = [
                'name' => $conn->real_escape_string($_POST['name']),
                'sursurname' => $conn->real_escape_string($_POST['surname']),
                'party' => $conn->real_escape_string($_POST['party']),
                'committee' => $conn->real_escape_string($_POST['committee']),
                'portrait' => $imagePath,
            ];
            
            try {
                $politician = new Politician($conn, null);
                $politician->setData($data);
                $politician->sendToDb();
            } catch (Exception $e) {
                echo "An error has occurred";
            }
        }
        ?>

    </div>

<script src="/js/veryfyAllInputs.js"></script>
</body>

</html>