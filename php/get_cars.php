<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'db.php';

try {
    $stmt = $conn->prepare("
        SELECT
            c.car_id,
            c.brand,
            c.model,
            c.year,
            c.license_plate,
            c.price_per_day,
            c.status,
            c.image_url,
            c.description,
            c.category_id,
            cat.category_name
        FROM cars c
        LEFT JOIN categories cat ON c.category_id = cat.category_id
        ORDER BY c.car_id ASC
    ");

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Query prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode(['success' => true, 'cars' => $cars]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
