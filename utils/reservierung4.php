<?php
session_start();

$_SESSION['zimmer'] = 'Luxus Suite mit privatem Butler';

header("Location: ../index.php?page=reservation");
exit();