<?php
/**
 * SuRide — Logout Endpoint
 * POST /php/logout.php
 *
 * Destroys the PHP session and returns a success response.
 * The frontend should then clear sessionStorage and call showView('landing').
 *
 * Response (JSON):
 *   { "success": true, "message": "Logged out successfully." }
 */

require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) session_start();

/* ── Accept POST (or GET as fallback for simple redirect use) ─ */
// Fully destroy the session
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(
        session_name(), '', time() - 42000,
        $p['path'], $p['domain'], $p['secure'], $p['httponly']
    );
}
session_destroy();

jsonResponse(['success' => true, 'message' => 'Logged out successfully.']);
