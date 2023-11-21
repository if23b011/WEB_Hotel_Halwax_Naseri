<?php
session_start();

$_SESSION["login"] = false;
$_SESSION["registered"] = false;


header("Location: ../sites/index.php");
exit();
?>