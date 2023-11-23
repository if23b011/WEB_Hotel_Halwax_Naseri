<?php
session_start();

$_SESSION['zimmer'] = 'Luxus Zimmer mit Jacuzzi';

header("Location: ../sites/reservierung.php");
exit();
?>