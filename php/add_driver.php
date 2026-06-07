<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$driver_name   = trim($_POST['driver_name']   ?? '');
$phone_number  = trim($_POST['phone_number']  ?? '');
$driver_status = trim($_POST['driver_status'] ?? 'available');

if (empty($driver_name) || empty($phone_number)) {
    echo json_encode(['success' => false, 'message' => 'Driver name and phone number are required.']);
    exit;
}

$allowed = ['available', 'assigned', 'off'];
if (!in_array($driver_status, $allowed)) {
    $driver_status = 'available';
}

try {
    $stmt = $conn->prepare("INSERT INTO drivers (driver_name, phone_number, driver_status) VALUES (?, ?, ?)");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param('sss', $driver_name, $phone_number, $driver_status);

    if ($stmt->execute()) {
        $new_id = $conn->insert_id;
        $stmt->close();
        $conn->close();
        echo json_encode(['success' => true, 'message' => 'Driver added successfully.', 'driver_id' => $new_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
