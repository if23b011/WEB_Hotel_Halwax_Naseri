<?php
session_start();

setcookie("admin", "", time() - (84600 * 1000), "/");
setcookie("email", "", time() - (84600 * 1000), "/");

header("Location: ../sites/index.php");
exit();
?>