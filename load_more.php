<?php
/**
 * Fetches properties from the database with pagination and filtering.
 * This script is called via AJAX from the frontend to dynamically load properties.
 * It returns a structured JSON response.
 */

// Set the content type header to ensure the browser interprets the response as JSON.
header('Content-Type: application/json');

// Include the database configuration file.
include 'config/config.php';

// Initialize a default response structure. This ensures consistent JSON output.
$response = [
    'success' => false, 
    'data' => [], 
    'error' => 'An unknown error occurred.'
];

try {
    // --- 1. Get and Sanitize Input Parameters ---
    // Use intval for numeric parameters to ensure they are integers.
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 12;

    // Use the null coalescing operator for string and float parameters for cleaner code.
    $location = $_GET['location'] ?? '';
    $propertyType = $_GET['property_type'] ?? '';
    $minPrice = !empty($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
    $maxPrice = !empty($_GET['max_price']) ? (float)$_GET['max_price'] : 0;

    // --- 2. Build the SQL Query ---
    // The subquery for 'thumbnail' now prioritizes the flagged thumbnail, 
    // then the display order, ensuring the correct image is always chosen.
    $query = '
        SELECT p.*, 
               (SELECT image 
                FROM property_images pi 
                WHERE pi.property_id = p.id 
                ORDER BY pi.is_thumbnail DESC, pi.display_order ASC, pi.id ASC 
                LIMIT 1) as thumbnail
        FROM properties p
        WHERE p.hidden = FALSE
    ';
    
    // --- 3. Dynamically Append Filters to the Query ---
    if (!empty($location)) {
        $query .= ' AND p.location = :location';
    }
    if (!empty($propertyType)) {
        $query .= ' AND p.property_type = :propertyType';
    }
    if ($minPrice > 0) {
        $query .= ' AND p.price >= :minPrice';
    }
    if ($maxPrice > 0) {
        $query .= ' AND p.price <= :maxPrice';
    }

    // --- 4. Add Ordering and Pagination ---
    $query .= ' ORDER BY p.id DESC LIMIT :limit OFFSET :offset';
    
    // --- 5. Prepare and Execute the Query ---
    $stmt = $pdo->prepare($query);

    // Bind parameters explicitly for security and correctness.
    if (!empty($location)) {
        $stmt->bindValue(':location', $location, PDO::PARAM_STR);
    }
    if (!empty($propertyType)) {
        $stmt->bindValue(':propertyType', $propertyType, PDO::PARAM_STR);
    }
    if ($minPrice > 0) {
        $stmt->bindValue(':minPrice', $minPrice, PDO::PARAM_STR);
    }
    if ($maxPrice > 0) {
        $stmt->bindValue(':maxPrice', $maxPrice, PDO::PARAM_STR);
    }

    // Bind limit and offset as integers.
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // --- 6. Format the Success Response ---
    $response['success'] = true;
    $response['data'] = $properties;
    unset($response['error']); // Remove the default error message on success.

} catch (PDOException $e) {
    // Handle database-specific errors.
    $response['error'] = 'Database Error: Could not retrieve properties.';
    // In a production environment, you would log the error instead of exposing details.
    error_log('PDOException in load_more.php: ' . $e->getMessage());
} catch (Exception $e) {
    // Handle other general errors.
    $response['error'] = 'A general error occurred.';
    error_log('Exception in load_more.php: ' . $e->getMessage());
}

// --- 7. Send the Final JSON Response ---
echo json_encode($response);
?>
