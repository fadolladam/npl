<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $address = $_POST['address'];
    $google_map = $_POST['google_map'];
    $location = $_POST['location'];
    $property_type = $_POST['property_type'];
    $land_area = $_POST['land_area'];
    $building_area = $_POST['building_area'];
    $floors = $_POST['floors'];
    $bedrooms = $_POST['bedrooms'];
    $living_rooms = $_POST['living_rooms'];
    $bathrooms = $_POST['bathrooms'];
    $price = $_POST['price'];

    // Insert data into properties table
    $stmt = $pdo->prepare('INSERT INTO properties (title, address, google_map, location, property_type, land_area, building_area, floors, bedrooms, living_rooms, bathrooms, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$title, $address, $google_map, $location, $property_type, $land_area, $building_area, $floors, $bedrooms, $living_rooms, $bathrooms, $price]);
    $property_id = $pdo->lastInsertId();

    // Create a folder for the property images
    $property_image_folder = "../assets/images/property_$property_id";
    if (!file_exists($property_image_folder)) {
        mkdir($property_image_folder, 0777, true);
    }

    // Handle file uploads
    $images = $_FILES['images'];
    $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];

    for ($i = 0; $i < count($images['name']); $i++) {
        $image = $images['name'][$i];
        $target_file = $property_image_folder . '/' . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an image
        $check = getimagesize($images['tmp_name'][$i]);
        if ($check === false) {
            echo "File is not an image.";
            continue;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, $allowedFileTypes)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            continue;
        }

        // Move uploaded file to target location
        if (move_uploaded_file($images['tmp_name'][$i], $target_file)) {
            // Insert image record into property_images table
            $image_stmt = $pdo->prepare('INSERT INTO property_images (property_id, image) VALUES (?, ?)');
            $image_stmt->execute([$property_id, "property_$property_id/" . basename($image)]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    header('Location: index.php');
    exit();
} else {
    header('Location: admin_add_properties.php');
    exit();
}
?>
