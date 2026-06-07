<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$driver_id = intval($_POST['driver_id'] ?? 0);

if ($driver_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid driver ID.']);
    exit;
}

try {
    $stmt = $conn->prepare("DELETE FROM drivers WHERE driver_id = ?");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param('i', $driver_id);

    if ($stmt->execute()) {
        $affected = $stmt->affected_rows;
        $stmt->close();
        $conn->close();
        if ($affected === 0) {
            echo json_encode(['success' => false, 'message' => 'Driver not found.']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Driver deleted successfully.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
