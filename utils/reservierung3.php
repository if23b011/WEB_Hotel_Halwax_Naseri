<?php
session_start();

$_SESSION["zimmer"] = "Luxus Zimmer mit Jacuzzi";

header("Location: ../index.php?page=reservation");
exit();