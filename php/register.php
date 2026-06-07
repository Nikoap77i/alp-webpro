<?php
/**
 * SuRide — Register Endpoint
 * POST /php/register.php
 *
 * Request body (JSON):
 *   {
 *     "first_name": "...",
 *     "last_name":  "...",
 *     "email":      "...",
 *     "phone":      "...",
 *     "password":   "..."
 *   }
 *
 * All new accounts are assigned role = 'customer'.
 * Admin accounts must be seeded directly in the database.
 *
 * Response (JSON):
 *   { "success": true, "user": { "id", "name", "email", "role" } }
 *   { "success": false, "message": "..." }
 */

require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) session_start();

/* ── Only allow POST ───────────────────────────────────────── */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['success' => false, 'message' => 'Method not allowed.'], 405);
}

/* ── Parse JSON body ───────────────────────────────────────── */
$body       = json_decode(file_get_contents('php://input'), true) ?? [];
$firstName  = trim($body['first_name'] ?? '');
$lastName   = trim($body['last_name']  ?? '');
$email      = trim(strtolower($body['email']    ?? ''));
$phone      = trim($body['phone']      ?? '');
$password   = $body['password']  ?? '';

/* ── Validation ────────────────────────────────────────────── */
$errors = [];

if (strlen($firstName) < 2) $errors['first_name'] = 'First name is required.';
if (strlen($lastName)  < 2) $errors['last_name']  = 'Last name is required.';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

// Indonesian phone: starts with 08 or +62, 10-15 digits total
$phoneDigits = preg_replace('/[\s\-\+\(\)]/', '', $phone);
if (!preg_match('/^(08|628)\d{8,13}$/', $phoneDigits)) {
    $errors['phone'] = 'Please enter a valid Indonesian phone number.';
}

if (strlen($password) < 8) {
    $errors['password'] = 'Password must be at least 8 characters.';
}

if (!empty($errors)) {
    jsonResponse(['success' => false, 'message' => 'Validation failed.', 'errors' => $errors], 422);
}

/* ── Check for duplicate email ─────────────────────────────── */
$db   = getDB();
$chk  = $db->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
$chk->execute([$email]);
if ($chk->fetch()) {
    jsonResponse(['success' => false, 'message' => 'An account with this email already exists.'], 409);
}

/* ── Insert user ───────────────────────────────────────────── */
$hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
$ins  = $db->prepare(
    'INSERT INTO users (first_name, last_name, email, phone, password_hash, role, created_at)
     VALUES (?, ?, ?, ?, ?, ?, NOW())'
);
$ins->execute([$firstName, $lastName, $email, $phone, $hash, 'customer']);
$newId = (int) $db->lastInsertId();

/* ── Auto-login: create session ────────────────────────────── */
session_regenerate_id(true);
$_SESSION['suride_user'] = [
    'id'    => $newId,
    'name'  => "$firstName $lastName",
    'email' => $email,
    'role'  => 'customer',
];

/* ── Respond ───────────────────────────────────────────────── */
jsonResponse([
    'success' => true,
    'user'    => [
        'id'    => $newId,
        'name'  => "$firstName $lastName",
        'email' => $email,
        'role'  => 'customer',
    ],
], 201);
