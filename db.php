<?php

/**
 * @author Naim Ahmed
 * @copyright 2017
 */

$servername = "localhost";
$username = "root";
$password = "123123";
$dbname = "ip2location";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Could not connect to database: " . $conn->connect_error);
}

?>