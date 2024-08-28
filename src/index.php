<?php
if (isset($_COOKIE['id'])) {
  session_start();
  $_SESSION['id'] = $_COOKIE['id'];
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
  <title>Strona polityczna</title>

</head>

<body>

  <?php include_once __DIR__ . '/php/header.php'; ?>


  <div class="content">
  <p>Aktualna ilość partii: </p>
  <p>Aktualna ilość okręgów wyborczych: </p>
  <p>Aktualna ilość polityków: </p>

  </div>
  

</body>

</html>
