<?php
session_start();
include_once __DIR__ . '/php/scripts/login-mysql.php';
include_once __DIR__ . '/php/objects/User.php';

$id = User::getUserIdByWhatever($conn);
if ($id) {
  echo $id;
  header('Location: /dashboard.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/style.css">
  <?php include_once __DIR__ . '/php/html-snippets/icons.html' ?>
  <title>Strona polityczna</title>

</head>

<body>

  <?php include_once __DIR__ . '/php/html-snippets/header.html'; ?>


  <div class="content">
  <p>Aktualna ilość partii: </p>
  <p>Aktualna ilość okręgów wyborczych: </p>
  <p>Aktualna ilość polityków: </p>

  </div>
  

</body>

</html>
