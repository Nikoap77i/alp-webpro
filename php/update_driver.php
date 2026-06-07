<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$driver_id     = intval($_POST['driver_id']     ?? 0);
$driver_name   = trim($_POST['driver_name']     ?? '');
$phone_number  = trim($_POST['phone_number']    ?? '');
$driver_status = trim($_POST['driver_status']   ?? 'available');

if ($driver_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid driver ID.']);
    exit;
}

if (empty($driver_name) || empty($phone_number)) {
    echo json_encode(['success' => false, 'message' => 'Driver name and phone number are required.']);
    exit;
}

$allowed = ['available', 'assigned', 'off'];
if (!in_array($driver_status, $allowed)) {
    $driver_status = 'available';
}

try {
    $stmt = $conn->prepare("UPDATE drivers SET driver_name = ?, phone_number = ?, driver_status = ? WHERE driver_id = ?");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param('sssi', $driver_name, $phone_number, $driver_status, $driver_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        if ($stmt->affected_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'Driver not found or no changes made.']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Driver updated successfully.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
