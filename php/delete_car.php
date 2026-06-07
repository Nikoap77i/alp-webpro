<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$car_id = intval($_POST['car_id'] ?? 0);

if ($car_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid car ID.']);
    exit;
}

try {
    $stmt = $conn->prepare("DELETE FROM cars WHERE car_id = ?");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param('i', $car_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'Car not found.']);
        } else {
            echo json_encode(['success' => true, 'message' => 'Car deleted successfully.']);
        }
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
