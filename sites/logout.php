<?php
session_start();

$_SESSION["login"] = false;
$_SESSION["firstname"] = "";
$_SESSION["lastname"] = "";
$_SESSION["email"] = "";
$_SESSION["date"] = "";


header("Location: login.php");
exit();
?>