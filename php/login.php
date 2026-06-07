<?php
/**
 * SuRide — Login Endpoint
 * POST /php/login.php
 *
 * Request body (JSON):
 *   { "email": "...", "password": "..." }
 *
 * Response (JSON):
 *   { "success": true, "user": { "id", "name", "email", "role" } }
 *   { "success": false, "message": "..." }
 *
 * On success the server creates a PHP session so subsequent
 * requests can call requireAuth() / requireAdmin() in db.php.
 */

require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) session_start();

/* ── Only allow POST ───────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

/* ── Parse JSON body ───────────────────────────────────────── */
$body  = json_decode(file_get_contents('php://input'), true) ?? [];
$email = trim(strtolower($body['email'] ?? ''));
$pass  = $body['password'] ?? '';

/* ── Basic validation ──────────────────────────────────────── */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(['success' => false, 'message' => 'Please enter a valid email address.'], 422);
}
if (strlen($pass) < 6) {
    jsonResponse(['success' => false, 'message' => 'Password must be at least 6 characters.'], 422);
}

/* ── Look up user ──────────────────────────────────────────── */
$db   = getDB();
$stmt = $db->prepare('SELECT id, first_name, last_name, email, password_hash, role FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

/* ── Verify password ───────────────────────────────────────── */
if (!$user || !password_verify($pass, $user['password_hash'])) {
    // Generic message — do not reveal which field is wrong
    jsonResponse(['success' => false, 'message' => 'Invalid email or password.'], 401);
}

/* ── Create session ────────────────────────────────────────── */
session_regenerate_id(true);  // prevent session fixation
$_SESSION['suride_user'] = [
    'id'    => $user['id'],
    'name'  => $user['first_name'] . ' ' . $user['last_name'],
    'email' => $user['email'],
    'role'  => $user['role'],   // 'admin' | 'customer'
];

/* ── Respond ───────────────────────────────────────────────── */
jsonResponse([
    'success' => true,
    'user'    => [
        'id'    => $user['id'],
        'name'  => $user['first_name'] . ' ' . $user['last_name'],
        'email' => $user['email'],
        'role'  => $user['role'],
    ],
]);
