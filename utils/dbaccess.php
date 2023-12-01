<?php

$servername = "localhost";
$username = "if23b011";
$password = "";
$name = "hotel";

$conn = mysqli_connect($servername, $username, $password, $name);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}