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
$imageOrder = $input['order'] ?? [];

// Validate that the received order is a non-empty array
if (empty($imageOrder) || !is_array($imageOrder)) {
    echo json_encode(['success' => false, 'message' => 'No valid image order provided.']);
    exit();
}

try {
    // We need the property ID to scope all our database updates.
    // We can safely get it from the first image in the list.
    $firstImageId = intval($imageOrder[0]);
    $stmt_prop = $pdo->prepare('SELECT property_id FROM property_images WHERE id = :id');
    $stmt_prop->execute([':id' => $firstImageId]);
    $propertyId = $stmt_prop->fetchColumn();

    if (!$propertyId) {
        throw new Exception('Could not determine the property ID for the images.');
    }

    $pdo->beginTransaction();

    // The core fix: Loop through the new order from the drag-and-drop action.
    // For each image, update both its display order and its thumbnail status.
    foreach ($imageOrder as $index => $imageId) {
        // The first image in the array (at index 0) is the new thumbnail.
        $isThumbnail = ($index === 0) ? 1 : 0; 
        
        $stmt = $pdo->prepare('
            UPDATE property_images 
            SET display_order = :display_order, is_thumbnail = :is_thumbnail 
            WHERE id = :image_id AND property_id = :property_id
        ');
        
        $stmt->execute([
            ':display_order' => $index,
            ':is_thumbnail'  => $isThumbnail,
            ':image_id'      => intval($imageId),
            ':property_id'   => $propertyId // Ensure we only update images for this specific property
        ]);
    }

    $pdo->commit();
    echo json_encode(['success' => true, 'message' => 'Image order and thumbnail updated successfully.']);

} catch (Exception $e) {
    // If anything goes wrong, roll back the transaction to prevent partial updates.
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    // Log the detailed error for debugging and show a generic message to the user.
    error_log("Reorder images error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'A database error occurred while reordering.']);
}
?>
