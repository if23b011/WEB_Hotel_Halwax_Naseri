<?php
session_start();

$_SESSION["login"] = false;
$_SESSION["registered"] = false;
$_SESSION["admin"] = false;


header("Location: ../sites/index.php");
exit();
?>