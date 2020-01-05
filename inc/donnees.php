<?php

/**
 * Establish connection to database
 * @return mysqli
 */
function connect() {
    $servername = "localhost";
    $username = "admin";
    $password = "Admin@123";
    $database = "well_test_nordisk";

// Create connection
    $conn = new mysqli($servername, $username, $password, $database);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function close($con) {
    return $con->close();
}

