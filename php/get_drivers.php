<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'db.php';

try {
    $stmt = $conn->prepare("SELECT driver_id, driver_name, phone_number, driver_status FROM drivers ORDER BY driver_id ASC");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $drivers = [];
    while ($row = $result->fetch_assoc()) {
        $drivers[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['success' => true, 'drivers' => $drivers]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
