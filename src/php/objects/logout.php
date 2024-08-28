<?php

session_unset();
session_destroy();

setcookie('id', '', time() -3600,'/');

header('Location: /index.php');
exit();