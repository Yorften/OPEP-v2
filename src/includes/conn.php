<?php

$server = "sql11.freesqldatabase.com";
$user = "sql11666735";
$password = "YL4Lq1JXpz";
$database = "sql11666735";

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
