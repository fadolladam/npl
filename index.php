<?php 
include 'config/config.php';
include 'includes/header.php'; 
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Properties for Sale</h1>
    <p class="text-center text-muted mb-5">Browse through our exclusive list of non-performing loan properties.</p>

    <!-- Search Filters (now trigger search automatically) -->
    <div class="search-filters">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <select id="location" class="form-select" aria-label="Select Location">
                    <option value="" selected>All Locations</option>
                    <?php
                    $locations = $pdo->query('SELECT DISTINCT location FROM properties WHERE hidden = FALSE ORDER BY location ASC')->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($locations as $location) {
                        echo '<option value="'.htmlspecialchars($location['location']).'">'.htmlspecialchars($location['location']).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <select id="propertyType" class="form-select" aria-label="Select Property Type">
                    <option value="" selected>All Property Types</option>
                    <?php
                    $propertyTypes = $pdo->query('SELECT DISTINCT property_type FROM properties WHERE hidden = FALSE ORDER BY property_type ASC')->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($propertyTypes as $propertyType) {
                        echo '<option value="'.htmlspecialchars($propertyType['property_type']).'">'.htmlspecialchars($propertyType['property_type']).'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" id="minPrice" class="form-control" placeholder="Min Price ($)">
            </div>
            <div class="col-md-2">
                <input type="number" id="maxPrice" class="form-control" placeholder="Max Price ($)">
            </div>
        </div>
    </div>

    <!-- Property Cards Container -->
    <div id="property-cards" class="row">
        <!-- Property cards will be loaded here by scripts.js -->
    </div>

    <!-- Loading Indicator -->
    <div id="loading-indicator" style="display: none;">
        <div class="d-flex justify-content-center py-4">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
