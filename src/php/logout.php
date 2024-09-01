<?php

session_unset();
session_destroy();

setcookie('login', '', time() -3600,'/');
setcookie('passphrase', '', time() -3600,'/');

header('Location: /index.php');
exit();