<?php
// SuRide Database Connection

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // MySQL username
define('DB_PASS', '');            // MySQL password
define('DB_NAME', 'suride_db');   // database name

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    http_response_code(500);
    header('Content-Type: application/json');
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]));
}

$conn->set_charset('utf8mb4');
