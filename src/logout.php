<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '', time() - 7200);
setcookie('key', '', time() - 7200);

header('Location: login.php');
