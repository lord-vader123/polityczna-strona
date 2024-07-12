<?php

# ustawienia połączenia z bazą danych

$serverName = "localhost";
$userName = "root";
$password = "";
$db_name = "politycy";

# utworzenie połączenia z bazą danych o nazwie conn

$conn = new mysqli($serverName, $userName, $password, $db_name);

# sprawdzenie poprawności połączenia

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
