<?php
session_start();

setcookie("admin", "", time() - (84600 * 1000), "/");
setcookie("email", "", time() - (84600 * 1000), "/");
session_destroy();

header("Location: ../index.php");
exit();