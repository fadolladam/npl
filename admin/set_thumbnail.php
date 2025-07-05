<?php
session_start();
header('Content-Type: application/json');

// Security check: ensure user is a logged-in admin
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

include '../config/config.php';

$input = json_decode(file_get_contents('php://input'), true);
$imageId = $input['imageId'] ?? 0;
$propertyId = $input['propertyId'] ?? 0;

if ($imageId <= 0 || $propertyId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid image or property ID.']);
    exit();
}

try {
    $pdo->beginTransaction();

    // Step 1: Remove the thumbnail flag from all other images for this property
    $stmt_reset = $pdo->prepare('UPDATE property_images SET is_thumbnail = 0 WHERE property_id = :property_id');
    $stmt_reset->execute([':property_id' => $propertyId]);

    // Step 2: Set the new thumbnail flag for the selected image
    $stmt_set = $pdo->prepare('UPDATE property_images SET is_thumbnail = 1 WHERE id = :image_id AND property_id = :property_id');
    $stmt_set->execute([':image_id' => $imageId, ':property_id' => $propertyId]);

    $pdo->commit();
    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    $pdo->rollBack();
    // In a production environment, log the error instead of echoing it.
    // error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error occurred.']);
}
?>
