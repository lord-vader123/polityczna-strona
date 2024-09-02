<?php
include_once __DIR__ . '/../scripts/login-mysql.php';
include_once __DIR__ . '/../objects/Committee.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once __DIR__ . '/../html-snippets/icons.html'; ?>
    <link rel="stylesheet" href="/css/style.css">
    <title>Utwórz komitet</title>
</head>
<body>

<?php include_once __DIR__ . '/../html-snippets/header-logged.html'; ?>

<div class="content">

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'] == 'POST') ?>" method="post">
        <label for="name">Nazwa komitetu</label>
        <input type="text" name="name" id="name">
        <button type="submit">Zatwierdź</button>
    </form>

    <div id="error">
    
        
    </div>
</div>

<script src="/js/veryfyAllInputs.js"></script>    

</body>
</html>