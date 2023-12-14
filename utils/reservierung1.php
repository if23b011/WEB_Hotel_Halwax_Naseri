<?php
session_start();

$_SESSION['zimmer'] = 'Einzelzimmer mit Einzelbett';

header("Location: ../index.php?page=reservation");
exit();