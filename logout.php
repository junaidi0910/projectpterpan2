<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
setcookie('id_user', '', time() - 3600);
header("location: index.php");
exit;
?>