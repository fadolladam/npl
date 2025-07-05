<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: auth/login.php');
    exit();
}

include '../config/config.php';

try {
    // Start a transaction
    $pdo->beginTransaction();

    // Drop existing tables
    $pdo->exec('DROP TABLE IF EXISTS property_images');
    $pdo->exec('DROP TABLE IF EXISTS properties');
    $pdo->exec('DROP TABLE IF EXISTS users');

    // Create tables
    $pdo->exec('
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL,
            role VARCHAR(50) NOT NULL
        )
    ');

    $pdo->exec('
        CREATE TABLE properties (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            address TEXT NOT NULL,
            google_map VARCHAR(255) NOT NULL,
            location VARCHAR(255) NOT NULL,
            property_type VARCHAR(255) NOT NULL,
            land_area VARCHAR(255) NOT NULL,
            building_area VARCHAR(255) NOT NULL,
            floors INT NOT NULL,
            bedrooms INT NOT NULL,
            living_rooms INT NOT NULL,
            bathrooms INT NOT NULL,
            price DECIMAL(15, 2) NOT NULL,
            hidden BOOLEAN DEFAULT FALSE
        )
    ');

    $pdo->exec('
        CREATE TABLE property_images (
            id INT AUTO_INCREMENT PRIMARY KEY,
            property_id INT NOT NULL,
            image VARCHAR(255) NOT NULL,
            FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE
        )
    ');

    // Insert default admin users
    $users = [
        ['username' => 'admin1', 'password' => 'cCtTeBx4kHQEQ877', 'role' => 'admin'],
        ['username' => 'admin2', 'password' => '6hKFY2HOco5sIjrB', 'role' => 'admin'],
        ['username' => 'admin3', 'password' => 'gszOk1OOx6ll303T', 'role' => 'admin'],
    ];

    foreach ($users as $user) {
        $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
        $stmt->execute([$user['username'], $hashedPassword, $user['role']]);
    }

    // Insert new dummy data into the properties table
    $properties = [
        [
            'title' => 'Phnom Penh Heights',
            'address' => 'Unit 101, 5th Ave, Phnom Penh City, 12345',
            'google_map' => 'https://maps.google.com',
            'location' => 'Phnom Penh',
            'property_type' => 'House',
            'land_area' => '120 sqm',
            'building_area' => '350 sqm',
            'floors' => 2,
            'bedrooms' => 4,
            'living_rooms' => 2,
            'bathrooms' => 3,
            'price' => 350000,
            'images' => ['house_01.png', 'house_01_1.png', 'house_01_2.png']
        ],
        [
            'title' => 'Siem Reap Residences',
            'address' => 'Unit B2, Maple St, Siem Reap Town, 67890',
            'google_map' => 'https://maps.google.com',
            'location' => 'Siem Reap',
            'property_type' => 'Apartment',
            'land_area' => '200 sqm',
            'building_area' => '400 sqm',
            'floors' => 1,
            'bedrooms' => 3,
            'living_rooms' => 1,
            'bathrooms' => 2,
            'price' => 450000,
            'images' => ['house_02.png', 'house_02_1.png', 'house_02_2.png']
        ],
        [
            'title' => 'Sihanoukville Villas',
            'address' => 'Unit C3, Oakwood Rd, Sihanoukville Park, 11223',
            'google_map' => 'https://maps.google.com',
            'location' => 'Sihanoukville',
            'property_type' => 'Villa',
            'land_area' => '180 sqm',
            'building_area' => '500 sqm',
            'floors' => 3,
            'bedrooms' => 5,
            'living_rooms' => 3,
            'bathrooms' => 4,
            'price' => 600000,
            'images' => ['house_03.png', 'house_03_1.png', 'house_03_2.png']
        ],
        [
            'title' => 'Battambang Apartments',
            'address' => 'Unit D4, Sunset Blvd, Battambang City, 33445',
            'google_map' => 'https://maps.google.com',
            'location' => 'Battambang',
            'property_type' => 'Apartment',
            'land_area' => '90 sqm',
            'building_area' => '300 sqm',
            'floors' => 2,
            'bedrooms' => 2,
            'living_rooms' => 1,
            'bathrooms' => 1,
            'price' => 250000,
            'images' => ['house_04.jpg', 'house_04_1.jpg', 'house_04_2.jpg']
        ],
        [
            'title' => 'Kampong Cham Homes',
            'address' => 'Unit E5, Lakeside Dr, Kampong Cham Town, 55667',
            'google_map' => 'https://maps.google.com',
            'location' => 'Kampong Cham',
            'property_type' => 'House',
            'land_area' => '150 sqm',
            'building_area' => '350 sqm',
            'floors' => 2,
            'bedrooms' => 3,
            'living_rooms' => 2,
            'bathrooms' => 3,
            'price' => 400000,
            'images' => ['house_05.jpg', 'house_05_1.jpg', 'house_05_2.jpg']
        ],
        [
            'title' => 'Kampot Estates',
            'address' => 'Unit F6, Riverside Ave, Kampot Village, 77889',
            'google_map' => 'https://maps.google.com',
            'location' => 'Kampot',
            'property_type' => 'House',
            'land_area' => '130 sqm',
            'building_area' => '280 sqm',
            'floors' => 1,
            'bedrooms' => 2,
            'living_rooms' => 1,
            'bathrooms' => 2,
            'price' => 300000,
            'images' => ['house_06.jpg', 'house_06_1.jpg', 'house_06_2.jpg']
        ],
        [
            'title' => 'Kep Mountain View',
            'address' => 'Unit G7, Mountain Rd, Kep Town, 99000',
            'google_map' => 'https://maps.google.com',
            'location' => 'Kep',
            'property_type' => 'House',
            'land_area' => '160 sqm',
            'building_area' => '420 sqm',
            'floors' => 2,
            'bedrooms' => 4,
            'living_rooms' => 2,
            'bathrooms' => 3,
            'price' => 380000,
            'images' => ['house_07.jpg', 'house_07_1.jpg', 'house_07_2.jpg']
        ],
        [
            'title' => 'Koh Kong Retreat',
            'address' => 'Unit H8, Seaside Ln, Koh Kong City, 11121',
            'google_map' => 'https://maps.google.com',
            'location' => 'Koh Kong',
            'property_type' => 'Villa',
            'land_area' => '170 sqm',
            'building_area' => '450 sqm',
            'floors' => 3,
            'bedrooms' => 5,
            'living_rooms' => 3,
            'bathrooms' => 4,
            'price' => 620000,
            'images' => ['house_08.jpg', 'house_08_1.jpg', 'house_08_2.jpg']
        ],
        [
            'title' => 'Takeo Cottage',
            'address' => 'Unit I9, Country Rd, Takeo Town, 23232',
            'google_map' => 'https://maps.google.com',
            'location' => 'Takeo',
            'property_type' => 'Cottage',
            'land_area' => '200 sqm',
            'building_area' => '500 sqm',
            'floors' => 1,
            'bedrooms' => 3,
            'living_rooms' => 1,
            'bathrooms' => 2,
            'price' => 470000,
            'images' => ['house_09.jpg', 'house_09_1.jpg', 'house_09_2.jpg']
        ],
        [
            'title' => 'Kampong Speu Loft',
            'address' => 'Unit J10, Urban St, Kampong Speu City, 34343',
            'google_map' => 'https://maps.google.com',
            'location' => 'Kampong Speu',
            'property_type' => 'Loft',
            'land_area' => '80 sqm',
            'building_area' => '150 sqm',
            'floors' => 2,
            'bedrooms' => 1,
            'living_rooms' => 1,
            'bathrooms' => 1,
            'price' => 220000,
            'images' => ['house_10.jpg', 'house_10_1.jpg', 'house_10_2.jpg']
        ],
        [
            'title' => 'Prey Veng Manor',
            'address' => 'Unit K11, Hillside Ave, Prey Veng Town, 45454',
            'google_map' => 'https://maps.google.com',
            'location' => 'Prey Veng',
            'property_type' => 'Manor',
            'land_area' => '190 sqm',
            'building_area' => '410 sqm',
            'floors' => 2,
            'bedrooms' => 4,
            'living_rooms' => 2,
            'bathrooms' => 3,
            'price' => 390000,
            'images' => ['house_11.jpg', 'house_11_1.jpg', 'house_11_2.jpg']
        ],
        [
            'title' => 'Ratanakiri Cabin',
            'address' => 'Unit L12, Forest Dr, Ratanakiri Park, 56565',
            'google_map' => 'https://maps.google.com',
            'location' => 'Ratanakiri',
            'property_type' => 'Cabin',
            'land_area' => '130 sqm',
            'building_area' => '270 sqm',
            'floors' => 1,
            'bedrooms' => 2,
            'living_rooms' => 1,
            'bathrooms' => 1,
            'price' => 310000,
            'images' => ['house_12.jpg', 'house_12_1.jpg', 'house_12_2.jpg']
        ],
        // Additional properties here...
    ];

    // Insert properties and images
    $stmt = $pdo->prepare('INSERT INTO properties (title, address, google_map, location, property_type, land_area, building_area, floors, bedrooms, living_rooms, bathrooms, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt_image = $pdo->prepare('INSERT INTO property_images (property_id, image) VALUES (?, ?)');
    foreach ($properties as $property) {
        $stmt->execute([
            $property['title'],
            $property['address'],
            $property['google_map'],
            $property['location'],
            $property['property_type'],
            $property['land_area'],
            $property['building_area'],
            $property['floors'],
            $property['bedrooms'],
            $property['living_rooms'],
            $property['bathrooms'],
            $property['price']
        ]);
        $property_id = $pdo->lastInsertId();

        foreach ($property['images'] as $image) {
            $stmt_image->execute([$property_id, "property_$property_id/" . $image]);
            // Ensure the directory exists for each property
            $property_image_folder = "../assets/images/property_$property_id";
            if (!file_exists($property_image_folder)) {
                mkdir($property_image_folder, 0777, true);
            }
            copy("../assets/images/$image", "$property_image_folder/$image");
        }
    }

    // Commit the transaction
    $pdo->commit();

    echo "Database has been reset successfully.";

} catch (PDOException $e) {
    // Check if there is an active transaction and roll back
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo 'Error resetting database: ' . $e->getMessage();
}
?>
