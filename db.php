<?php
// ================================================
// db.php — SuRide Database Connection
// ================================================
// Edit the constants below to match your environment.
// Place this file outside public root in production.
// ================================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'suride_db');
define('DB_USER', 'root');       // change to your MySQL username
define('DB_PASS', '');           // change to your MySQL password
define('DB_PORT', 3306);
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=%s',
        DB_HOST, DB_PORT, DB_NAME, DB_CHARSET
    );
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
        exit;
    }
    return $pdo;
}
