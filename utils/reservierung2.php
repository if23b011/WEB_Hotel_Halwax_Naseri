<?php
session_start();

$_SESSION['zimmer'] = 'Einzelzimmer mit Doppelbett';

header("Location: ../sites/reservierung.php");
exit();
?>