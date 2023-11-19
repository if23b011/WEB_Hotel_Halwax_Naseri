<?php
session_start();

$_SESSION['zimmer'] = 'Luxus Zimmer';

header("Location: ../sites/reservierung.php");
exit();
?>