<?php
session_start();

$_SESSION["admin"] = false;
setcookie("email", "", time() - (84600 * 1000), "/");

header("Location: ../sites/index.php");
exit();
?>