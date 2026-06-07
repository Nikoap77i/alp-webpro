<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$brand       = trim($_POST['brand']       ?? '');
$model       = trim($_POST['model']       ?? '');
$year        = intval($_POST['year']       ?? 0);
$license_plate = trim($_POST['license_plate'] ?? '');
$category_id = intval($_POST['category_id'] ?? 0);
$status      = trim($_POST['status']      ?? 'available');
$price_per_day = floatval($_POST['price_per_day'] ?? 0);
$image_url   = trim($_POST['image_url']   ?? '');
$description = trim($_POST['description'] ?? '');

if (!$brand || !$model || !$year || !$license_plate || !$category_id || !$price_per_day) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

$allowed_statuses = ['available', 'rented', 'maintenance'];
if (!in_array($status, $allowed_statuses)) {
    $status = 'available';
}

try {
    $stmt = $conn->prepare("
        INSERT INTO cars (brand, model, year, license_plate, category_id, status, price_per_day, image_url, description)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param('ssissdss', $brand, $model, $year, $license_plate, $category_id, $status, $price_per_day, $image_url, $description);

    if ($stmt->execute()) {
        $new_id = $conn->insert_id;
        $stmt->close();
        $conn->close();
        echo json_encode(['success' => true, 'message' => 'Car added successfully.', 'car_id' => $new_id]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Execute failed: ' . $stmt->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
