<?php
session_start();

$_SESSION['zimmer'] = 'Suite';

header("Location: ../sites/reservierung.php");
exit();
?>