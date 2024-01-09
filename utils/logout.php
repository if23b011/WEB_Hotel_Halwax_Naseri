<?php
session_start();
setcookie("email", "", time() - 3600, "/", null, false, true);
setcookie("admin", "", time() - 3600, "/", null, false, true);
session_destroy();
header("Location: ../index.php?page=landing&error=noneLogout");
exit();