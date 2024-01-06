<?php
session_start();
$_SESSION["login"] = false;
$_SESSION["admin"] = false;
$_SESSION["email"] = "";
session_destroy();
header("Location: ../index.php");
exit();