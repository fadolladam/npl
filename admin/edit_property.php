<?php
session_start();
// Ensure the user is an authenticated admin.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: auth/login.php');
    exit();
}

include '../config/config.php';

// Get and sanitize property ID from URL.
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit();
}

// --- Handle Form Submission (POST Request) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve all form data.
    $title = trim($_POST['title']);
    $address = trim($_POST['address']);
    $google_map = trim($_POST['google_map']);
    $location = trim($_POST['location']);
    $property_type = trim($_POST['property_type']);
    $land_area = trim($_POST['land_area']);
    $building_area = trim($_POST['building_area']);
    $floors = intval($_POST['floors']);
    $bedrooms = intval($_POST['bedrooms']);
    $living_rooms = intval($_POST['living_rooms']);
    $bathrooms = intval($_POST['bathrooms']);
    $price = floatval($_POST['price']);
    $hidden = isset($_POST['hidden']) ? 1 : 0;

    // Prepare and execute the UPDATE statement for property details.
    $stmt = $pdo->prepare('
        UPDATE properties SET 
        title = :title, address = :address, google_map = :google_map, location = :location, 
        property_type = :property_type, land_area = :land_area, building_area = :building_area, 
        floors = :floors, bedrooms = :bedrooms, living_rooms = :living_rooms, 
        bathrooms = :bathrooms, price = :price, hidden = :hidden 
        WHERE id = :id
    ');
    $stmt->execute([
        ':title' => $title, ':address' => $address, ':google_map' => $google_map, ':location' => $location,
        ':property_type' => $property_type, ':land_area' => $land_area, ':building_area' => $building_area,
        ':floors' => $floors, ':bedrooms' => $bedrooms, ':living_rooms' => $living_rooms,
        ':bathrooms' => $bathrooms, ':price' => $price, ':hidden' => $hidden, ':id' => $id
    ]);

    // Handle new image uploads.
    if (!empty($_FILES['images']['name'][0])) {
        // Get the highest current display_order to append new images correctly.
        $stmt_order = $pdo->prepare('SELECT MAX(display_order) as max_order FROM property_images WHERE property_id = :id');
        $stmt_order->execute([':id' => $id]);
        $max_order = $stmt_order->fetchColumn() ?? -1;

        foreach ($_FILES['images']['name'] as $key => $image_name) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $target_file = "../assets/images/" . basename($image_name);
                move_uploaded_file($_FILES['images']['tmp_name'][$key], $target_file);

                $image_stmt = $pdo->prepare('INSERT INTO property_images (property_id, image, display_order) VALUES (:property_id, :image, :display_order)');
                $image_stmt->execute([':property_id' => $id, ':image' => $image_name, ':display_order' => ++$max_order]);
            }
        }
    }

    $_SESSION['flash_message'] = "Property updated successfully!";
    header('Location: edit_property.php?id=' . $id);
    exit();
}

// --- Fetch existing data for the form ---
$stmt = $pdo->prepare('SELECT * FROM properties WHERE id = :id');
$stmt->execute([':id' => $id]);
$property = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$property) {
    header('Location: index.php');
    exit();
}

// Fetch images, ordered by their display order.
$image_stmt = $pdo->prepare('SELECT * FROM property_images WHERE property_id = :id ORDER BY display_order ASC');
$image_stmt->execute([':id' => $id]);
$property_images = $image_stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
?>
<!-- Add SortableJS library from a CDN for drag-and-drop -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
    /* Styles for the image management UI */
    .image-gallery .image-container { position: relative; cursor: grab; }
    .image-gallery .thumbnail-overlay { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 103, 177, 0.7); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; opacity: 0; transition: opacity 0.3s ease; pointer-events: none; }
    .image-gallery .image-container.is-thumbnail .thumbnail-overlay { opacity: 1; }
    .image-gallery .btn-set-thumbnail { position: absolute; bottom: 5px; left: 5px; z-index: 10; }
    .image-gallery .btn-delete-image { position: absolute; top: 5px; right: 5px; z-index: 10; }
    .sortable-ghost { opacity: 0.4; background: #f0f0f0; border: 2px dashed #0067B1; }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Property</h2>
        <a href="index.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Dashboard</a>
    </div>

    <!-- Display success/error messages -->
    <?php
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . htmlspecialchars($_SESSION['flash_message']) . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['flash_message']);
    }
    ?>

    <form action="edit_property.php?id=<?php echo htmlspecialchars($id); ?>" method="POST" enctype="multipart/form-data" class="card p-4">
        <div class="row">
            <!-- Left Column: Property Details -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" required><?php echo htmlspecialchars($property['address']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="google_map" class="form-label">Google Map URL</label>
                    <input type="url" class="form-control" id="google_map" name="google_map" value="<?php echo htmlspecialchars($property['google_map']); ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label for="location" class="form-label">Location</label><input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required></div>
                    <div class="col-md-6 mb-3"><label for="property_type" class="form-label">Property Type</label><input type="text" class="form-control" id="property_type" name="property_type" value="<?php echo htmlspecialchars($property['property_type']); ?>" required></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3"><label for="land_area" class="form-label">Land Area</label><input type="text" class="form-control" id="land_area" name="land_area" value="<?php echo htmlspecialchars($property['land_area']); ?>" required></div>
                    <div class="col-md-6 mb-3"><label for="building_area" class="form-label">Building Area</label><input type="text" class="form-control" id="building_area" name="building_area" value="<?php echo htmlspecialchars($property['building_area']); ?>" required></div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3"><label for="floors" class="form-label">Floors</label><input type="number" class="form-control" id="floors" name="floors" value="<?php echo htmlspecialchars($property['floors']); ?>" required></div>
                    <div class="col-md-3 mb-3"><label for="bedrooms" class="form-label">Bedrooms</label><input type="number" class="form-control" id="bedrooms" name="bedrooms" value="<?php echo htmlspecialchars($property['bedrooms']); ?>" required></div>
                    <div class="col-md-3 mb-3"><label for="living_rooms" class="form-label">Living Rooms</label><input type="number" class="form-control" id="living_rooms" name="living_rooms" value="<?php echo htmlspecialchars($property['living_rooms']); ?>" required></div>
                    <div class="col-md-3 mb-3"><label for="bathrooms" class="form-label">Bathrooms</label><input type="number" class="form-control" id="bathrooms" name="bathrooms" value="<?php echo htmlspecialchars($property['bathrooms']); ?>" required></div>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($property['price']); ?>" required>
                </div>
                 <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="hidden" name="hidden" value="1" <?php echo $property['hidden'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="hidden">Hide this property from public view</label>
                </div>
            </div>

            <!-- Right Column: Image Management -->
            <div class="col-md-4">
                <h5>Image Management</h5>
                <div class="mb-3">
                    <label for="images" class="form-label">Upload New Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                </div>
                <p class="text-muted small">Drag and drop images to reorder them.</p>
                <div id="image-gallery" class="row g-2 image-gallery">
                    <?php foreach ($property_images as $image): ?>
                        <div id="image-<?php echo $image['id']; ?>" class="col-6 col-md-4 image-container <?php echo $image['is_thumbnail'] ? 'is-thumbnail' : ''; ?>" data-id="<?php echo $image['id']; ?>">
                            <img src="../assets/images/<?php echo htmlspecialchars($image['image']); ?>" class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;">
                            <div class="thumbnail-overlay">Thumbnail</div>
                            <button type="button" class="btn btn-light btn-sm btn-set-thumbnail" title="Set as Thumbnail" onclick="setAsThumbnail(<?php echo $image['id']; ?>, <?php echo $id; ?>)"><i class="fas fa-thumbtack"></i></button>
                            <button type="button" class="btn btn-danger btn-sm btn-delete-image" title="Delete Image" onclick="deleteImage(<?php echo $image['id']; ?>, this)"><i class="fas fa-times"></i></button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary">Save All Changes</button>
        </div>
    </form>
</div>

<script>
// --- Initialize SortableJS for drag-and-drop ---
const gallery = document.getElementById('image-gallery');
if (gallery) {
    new Sortable(gallery, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        onEnd: function () {
            const order = Array.from(gallery.children).map(el => el.dataset.id);
            updateImageOrder(order);
        }
    });
}

// --- Function to update image order via Fetch API ---
function updateImageOrder(order) {
    fetch('reorder_images.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ order: order })
    }).then(res => res.json()).then(data => {
        if (!data.success) alert('Error: Could not reorder images.');
    }).catch(err => console.error('Reorder error:', err));
}

// --- Function to set an image as the thumbnail ---
function setAsThumbnail(imageId, propertyId) {
    fetch('set_thumbnail.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ imageId: imageId, propertyId: propertyId })
    }).then(res => res.json()).then(data => {
        if (data.success) {
            document.querySelectorAll('.image-container').forEach(el => el.classList.remove('is-thumbnail'));
            document.getElementById('image-' + imageId).classList.add('is-thumbnail');
        } else {
            alert('Error: Could not set thumbnail.');
        }
    }).catch(err => console.error('Thumbnail error:', err));
}

// --- Function to delete an image ---
function deleteImage(imageId, buttonElement) {
    if (!confirm('Are you sure you want to permanently delete this image?')) return;

    fetch('delete_image.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ imageId: imageId })
    }).then(res => res.json()).then(data => {
        if (data.success) {
            buttonElement.closest('.image-container').remove();
        } else {
            alert('Failed to delete image: ' + (data.message || 'Unknown error'));
        }
    }).catch(err => console.error('Delete error:', err));
}
</script>

<?php include '../includes/footer.php'; ?>
