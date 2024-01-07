<?php
session_start();

$_SESSION["zimmer"] = "Einzelzimmer mit Doppelbett";

header("Location: ../index.php?page=reservation");
exit();