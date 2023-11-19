<?php
session_start();

$_SESSION["login"] = false;
$_SESSION["registered"] = false;
$_SESSION["firstname"] = "";
$_SESSION["lastname"] = "";
$_SESSION["email"] = "";
$_SESSION["date"] = "";


header("Location: index.php");
exit();
?>