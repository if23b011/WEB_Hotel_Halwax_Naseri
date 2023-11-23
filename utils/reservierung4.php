<?php
session_start();

$_SESSION['zimmer'] = 'Luxus Suite mit privatem Butler';

header("Location: ../sites/reservierung.php");
exit();
?>