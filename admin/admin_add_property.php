<?php
session_start();
// Ensure the user is an authenticated admin.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: auth/login.php');
    exit();
}

// Include header.
include '../includes/header.php';
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Add New Property</h2>
        <a href="index.php" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>

    <!-- The form now points to the correct processing script: add_property.php -->
    <form action="add_property.php" method="POST" enctype="multipart/form-data" class="card p-4">
        <div class="row">
            <!-- Left Column: Property Details -->
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="google_map" class="form-label">Google Map URL</label>
                    <input type="url" class="form-control" id="google_map" name="google_map" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="property_type" class="form-label">Property Type</label>
                        <input type="text" class="form-control" id="property_type" name="property_type" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="land_area" class="form-label">Land Area</label>
                        <input type="text" class="form-control" id="land_area" name="land_area" placeholder="e.g., 120 sqm" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="building_area" class="form-label">Building Area</label>
                        <input type="text" class="form-control" id="building_area" placeholder="e.g., 350 sqm" name="building_area" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3"><label for="floors" class="form-label">Floors</label><input type="number" class="form-control" id="floors" name="floors" value="0" required></div>
                    <div class="col-md-3 mb-3"><label for="bedrooms" class="form-label">Bedrooms</label><input type="number" class="form-control" id="bedrooms" name="bedrooms" value="0" required></div>
                    <div class="col-md-3 mb-3"><label for="living_rooms" class="form-label">Living Rooms</label><input type="number" class="form-control" id="living_rooms" name="living_rooms" value="0" required></div>
                    <div class="col-md-3 mb-3"><label for="bathrooms" class="form-label">Bathrooms</label><input type="number" class="form-control" id="bathrooms" name="bathrooms" value="0" required></div>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                </div>
            </div>

            <!-- Right Column: Images -->
            <div class="col-md-4">
                <h5>Images</h5>
                <div class="mb-3">
                    <label for="images" class="form-label">Upload Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple required onchange="previewImages(event)">
                </div>
                <div id="imagePreviews" class="row g-2">
                    <!-- Image previews will be shown here -->
                </div>
            </div>
        </div>
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary">Add Property</button>
        </div>
    </form>
</div>

<script>
// JavaScript function to preview uploaded images before submitting the form.
function previewImages(event) {
    const imagePreviews = document.getElementById('imagePreviews');
    imagePreviews.innerHTML = ''; // Clear existing previews
    const files = event.target.files;

    if (files) {
        Array.from(files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'col-6 col-md-4';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid rounded';
                img.style.height = '80px';
                img.style.width = '100%';
                img.style.objectFit = 'cover';
                
                previewWrapper.appendChild(img);
                imagePreviews.appendChild(previewWrapper);
            }

            reader.readAsDataURL(file);
        });
    }
}
</script>

<?php include '../includes/footer.php'; ?>
