<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "voidstate";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed");
}

?>