<?php
include 'config/config.php';
include 'includes/header.php';

// Get property ID from URL, ensuring it's an integer
$property_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($property_id <= 0) {
    echo "<div class='container py-5 text-center'><h2>Invalid Property ID.</h2></div>";
    include 'includes/footer.php';
    exit();
}

// Fetch property details
$stmt = $pdo->prepare('SELECT * FROM properties WHERE id = :id AND hidden = FALSE');
$stmt->execute([':id' => $property_id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    echo "<div class='container py-5 text-center'><h2>Property not found or is currently unavailable.</h2></div>";
    include 'includes/footer.php';
    exit();
}

// Fetch property images
$img_stmt = $pdo->prepare('SELECT image FROM property_images WHERE property_id = :property_id');
$img_stmt->execute([':property_id' => $property_id]);
$images = $img_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch related properties (excluding the current one)
$related_stmt = $pdo->prepare('
    SELECT p.*, (SELECT image FROM property_images pi WHERE pi.property_id = p.id ORDER BY pi.id ASC LIMIT 1) as thumbnail
    FROM properties p
    WHERE p.location = :location AND p.id != :id AND p.hidden = FALSE
    LIMIT 4
');
$related_stmt->execute([':location' => $property['location'], ':id' => $property_id]);
$related_properties = $related_stmt->fetchAll(PDO::FETCH_ASSOC);

function format_price_details($price) {
    return '$' . number_format($price, 2);
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Property Image Gallery -->
            <div class="property-details-gallery mb-4">
                <?php if (!empty($images)): ?>
                    <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php foreach ($images as $index => $image): ?>
                                <button type="button" data-bs-target="#propertyCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
                            <?php endforeach; ?>
                        </div>
                        <div class="carousel-inner rounded">
                            <?php foreach ($images as $index => $image): ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="assets/images/<?php echo htmlspecialchars($image['image']); ?>" class="d-block w-100" alt="Property Image <?php echo $index + 1; ?>" onerror="this.onerror=null;this.src='https://placehold.co/1200x800/E2F5F9/0067B1?text=Image+Not+Found';">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                <?php else: ?>
                    <img src="https://placehold.co/1200x800/E2F5F9/0067B1?text=No+Images+Available" class="img-fluid rounded" alt="No Images">
                <?php endif; ?>
            </div>

            <!-- Property Info -->
            <div class="details-card">
                <h1 class="mb-2"><?php echo htmlspecialchars($property['title']); ?></h1>
                <p class="text-muted fs-5"><i class="fas fa-map-marker-alt me-2"></i><?php echo htmlspecialchars($property['address']); ?></p>
                <h2 class="text-primary my-4"><?php echo format_price_details($property['price']); ?></h2>
                
                <h3 class="border-bottom pb-2 mb-3">Property Details</h3>
                <ul class="details-list">
                    <li><strong>Property Type:</strong> <span><?php echo htmlspecialchars($property['property_type']); ?></span></li>
                    <li><strong>Location:</strong> <span><?php echo htmlspecialchars($property['location']); ?></span></li>
                    <li><strong>Land Area:</strong> <span><?php echo htmlspecialchars($property['land_area']); ?></span></li>
                    <li><strong>Building Area:</strong> <span><?php echo htmlspecialchars($property['building_area']); ?></span></li>
                    <li><strong>Floors:</strong> <span><?php echo htmlspecialchars($property['floors']); ?></span></li>
                    <li><strong>Bedrooms:</strong> <span><?php echo htmlspecialchars($property['bedrooms']); ?></span></li>
                    <li><strong>Living Rooms:</strong> <span><?php echo htmlspecialchars($property['living_rooms']); ?></span></li>
                    <li><strong>Bathrooms:</strong> <span><?php echo htmlspecialchars($property['bathrooms']); ?></span></li>
                </ul>

                <div class="mt-4">
                    <a href="<?php echo htmlspecialchars($property['google_map']); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-map-marked-alt me-2"></i>View on Google Maps</a>
                    <a href="contact_us.php" class="btn btn-danger"><i class="fas fa-envelope me-2"></i>I'm Interested</a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="details-card">
                <h3 class="border-bottom pb-2 mb-3">Related Properties</h3>
                <?php if (!empty($related_properties)): ?>
                    <?php foreach ($related_properties as $related): ?>
                        <div class="d-flex mb-3">
                            <a href="property_details.php?id=<?php echo $related['id']; ?>">
                                <img src="assets/images/<?php echo htmlspecialchars($related['thumbnail']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>" style="width: 100px; height: 75px; object-fit: cover; border-radius: 5px;" onerror="this.onerror=null;this.src='https://placehold.co/100x75/E2F5F9/0067B1?text=N/A';">
                            </a>
                            <div class="ms-3">
                                <h6 class="mb-1 text-truncate"><a href="property_details.php?id=<?php echo $related['id']; ?>" class="text-decoration-none"><?php echo htmlspecialchars($related['title']); ?></a></h6>
                                <p class="text-primary fw-bold mb-0"><?php echo format_price_details($related['price']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No related properties found in this location.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
