<?php
// ================================================
// users_api.php — SuRide Users CRUD API
// Accepts JSON body or form-data.
// All responses are JSON.
// ================================================

require_once __DIR__ . '/db.php';

header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');

// ── Helper: send JSON response ───────────────────
function respond(bool $success, string $message, $data = null, int $code = 200): void {
    http_response_code($code);
    $out = ['success' => $success, 'message' => $message];
    if ($data !== null) $out['data'] = $data;
    echo json_encode($out);
    exit;
}

// ── Helper: sanitize string ──────────────────────
function clean(?string $v): string {
    return trim(htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'));
}

// ── Route request ────────────────────────────────
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

// Parse JSON body if Content-Type is application/json
$body = [];
$raw = file_get_contents('php://input');
if ($raw) {
    $decoded = json_decode($raw, true);
    if (is_array($decoded)) $body = $decoded;
}
// Also merge POST (for form submissions)
$input = array_merge($_POST, $body);

// ── CSRF / Origin check (basic) ──────────────────
// For a real app, implement proper CSRF tokens.
// Here we just allow same-origin fetch requests.

switch ($method) {

    // ────────────────────────────────────────────
    // READ — GET /users_api.php?action=list
    //        GET /users_api.php?action=get&id=1
    // ────────────────────────────────────────────
    case 'GET':
        $pdo = getDB();

        if ($action === 'get') {
            $id = intval($_GET['id'] ?? 0);
            if (!$id) respond(false, 'Invalid user ID.', null, 400);

            $stmt = $pdo->prepare('SELECT user_id, full_name, email, phone_number, address, role, created_at, updated_at FROM users WHERE user_id = ?');
            $stmt->execute([$id]);
            $user = $stmt->fetch();
            if (!$user) respond(false, 'User not found.', null, 404);
            respond(true, 'OK', $user);

        } else { // default: list
            $search = '%' . trim($_GET['search'] ?? '') . '%';
            $role   = $_GET['role'] ?? '';

            $sql  = 'SELECT user_id, full_name, email, phone_number, address, role, created_at, updated_at FROM users WHERE 1=1';
            $params = [];

            if (trim($search, '%') !== '') {
                $sql .= ' AND (full_name LIKE ? OR email LIKE ? OR phone_number LIKE ?)';
                $params = array_merge($params, [$search, $search, $search]);
            }
            if ($role !== '') {
                $sql .= ' AND role = ?';
                $params[] = $role;
            }
            $sql .= ' ORDER BY created_at DESC';

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $users = $stmt->fetchAll();
            respond(true, 'OK', $users);
        }
        break;

    // ────────────────────────────────────────────
    // CREATE — POST /users_api.php?action=create
    // ────────────────────────────────────────────
    case 'POST':
        if ($action !== 'create') respond(false, 'Unknown action.', null, 400);

        $name    = clean($input['full_name']    ?? '');
        $email   = strtolower(clean($input['email']       ?? ''));
        $phone   = clean($input['phone_number'] ?? '');
        $address = clean($input['address']      ?? '');
        $password= $input['password']           ?? '';
        $role    = $input['role']               ?? 'customer';

        // Validation
        if (!$name)                            respond(false, 'Full name is required.',      null, 422);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) respond(false, 'Invalid email address.', null, 422);
        if (strlen($password) < 6)             respond(false, 'Password must be at least 6 characters.', null, 422);
        if (!in_array($role, ['admin', 'customer'])) $role = 'customer';

        $pdo = getDB();

        // Duplicate email check
        $chk = $pdo->prepare('SELECT user_id FROM users WHERE email = ?');
        $chk->execute([$email]);
        if ($chk->fetch()) respond(false, 'Email already registered.', null, 409);

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare(
            'INSERT INTO users (full_name, email, phone_number, address, password, role)
                VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([$name, $email, $phone, $address, $hash, $role]);
        $newId = $pdo->lastInsertId();

        // Return the new user (without password)
        $userStmt = $pdo->prepare('SELECT user_id, full_name, email, phone_number, address, role, created_at FROM users WHERE user_id = ?');
        $userStmt->execute([$newId]);
        respond(true, 'User created successfully.', $userStmt->fetch(), 201);
        break;

    // ────────────────────────────────────────────
    // UPDATE — PUT /users_api.php?action=update&id=1
    // ────────────────────────────────────────────
    case 'PUT':
        if ($action !== 'update') respond(false, 'Unknown action.', null, 400);

        $id      = intval($_GET['id'] ?? 0);
        if (!$id) respond(false, 'Invalid user ID.', null, 400);

        $name    = clean($input['full_name']    ?? '');
        $email   = strtolower(clean($input['email'] ?? ''));
        $phone   = clean($input['phone_number'] ?? '');
        $address = clean($input['address']      ?? '');
        $role    = $input['role']               ?? 'customer';
        $password= $input['password']           ?? '';

        if (!$name)                                   respond(false, 'Full name is required.',  null, 422);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) respond(false, 'Invalid email address.', null, 422);
        if (!in_array($role, ['admin', 'customer']))  $role = 'customer';

        $pdo = getDB();

        // Check user exists
        $chk = $pdo->prepare('SELECT user_id FROM users WHERE user_id = ?');
        $chk->execute([$id]);
        if (!$chk->fetch()) respond(false, 'User not found.', null, 404);

        // Duplicate email check (exclude self)
        $dupChk = $pdo->prepare('SELECT user_id FROM users WHERE email = ? AND user_id != ?');
        $dupChk->execute([$email, $id]);
        if ($dupChk->fetch()) respond(false, 'Email already used by another user.', null, 409);

        if ($password && strlen($password) >= 6) {
            // Update with new password
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare(
                'UPDATE users SET full_name=?, email=?, phone_number=?, address=?, password=?, role=? WHERE user_id=?'
            );
            $stmt->execute([$name, $email, $phone, $address, $hash, $role, $id]);
        } else {
            // Update without touching password
            $stmt = $pdo->prepare(
                'UPDATE users SET full_name=?, email=?, phone_number=?, address=?, role=? WHERE user_id=?'
            );
            $stmt->execute([$name, $email, $phone, $address, $role, $id]);
        }

        $userStmt = $pdo->prepare('SELECT user_id, full_name, email, phone_number, address, role, updated_at FROM users WHERE user_id = ?');
        $userStmt->execute([$id]);
        respond(true, 'User updated successfully.', $userStmt->fetch());
        break;

    // ────────────────────────────────────────────
    // DELETE — DELETE /users_api.php?action=delete&id=1
    // ────────────────────────────────────────────
    case 'DELETE':
        if ($action !== 'delete') respond(false, 'Unknown action.', null, 400);

        $id = intval($_GET['id'] ?? 0);
        if (!$id) respond(false, 'Invalid user ID.', null, 400);

        $pdo = getDB();
        $chk = $pdo->prepare('SELECT user_id FROM users WHERE user_id = ?');
        $chk->execute([$id]);
        if (!$chk->fetch()) respond(false, 'User not found.', null, 404);

        $stmt = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
        $stmt->execute([$id]);
        respond(true, 'User deleted successfully.');
        break;

    default:
        respond(false, 'Method not allowed.', null, 405);
}
