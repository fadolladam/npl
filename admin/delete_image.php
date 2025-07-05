<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

include '../config/config.php';

$data = json_decode(file_get_contents("php://input"), true);
$imageId = $data['imageId'] ?? null;

if ($imageId) {
    // Fetch the image record from the database
    $stmt = $pdo->prepare('SELECT * FROM property_images WHERE id = ?');
    $stmt->execute([$imageId]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $image_path = '../assets/images/' . $image['image'];

        // Delete the image file from the server
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete the image record from the database
        $stmt = $pdo->prepare('DELETE FROM property_images WHERE id = ?');
        $stmt->execute([$imageId]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Image not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid image ID']);
}
?>
