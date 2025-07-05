<?php
include 'config/config.php';

$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($property_id == 0) {
    echo json_encode([]);
    exit();
}

$query = 'SELECT image AS image_path FROM property_images WHERE property_id = :property_id';
$stmt = $pdo->prepare($query);
$stmt->bindValue(':property_id', $property_id, PDO::PARAM_INT);
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($images);
?>
