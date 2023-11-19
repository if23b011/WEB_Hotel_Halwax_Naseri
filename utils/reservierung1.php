<?php
session_start();

$_SESSION['zimmer'] = 'Einzelzimmer mit Einzelbett';

header("Location: ../sites/reservierung.php");
exit();
?>