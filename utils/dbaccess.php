<?php

$servername = "localhost";
$username = "admin";
$password = "";
$database = "hotel";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}