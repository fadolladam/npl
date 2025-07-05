<?php
session_start();
// Ensure the user is an authenticated admin.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: auth/login.php');
    exit();
}

include '../config/config.php';

/**
 * Handle hide/unhide actions before rendering the page.
 * This approach is more secure and prevents unexpected behavior.
 */
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID to ensure it's an integer.
    $action = $_GET['action'];

    // Use explicit integers (1 for hidden, 0 for visible) to match the database's TINYINT type.
    // This is the core fix for the "Incorrect integer value" error.
    $hidden_status = ($action === 'hide') ? 1 : 0;

    if ($id > 0) {
        try {
            $stmt = $pdo->prepare('UPDATE properties SET hidden = :hidden WHERE id = :id');
            $stmt->execute([':hidden' => $hidden_status, ':id' => $id]);
            $_SESSION['flash_message'] = "Property status updated successfully.";
        } catch (PDOException $e) {
            $_SESSION['flash_message'] = "Error updating property status.";
            // In a real application, you would log the error: error_log($e->getMessage());
        }
    }

    // Redirect to the same page without the GET parameters to prevent re-triggering the action on refresh.
    header('Location: index.php');
    exit();
}

// Fetch all properties to display in the dashboard.
// A subquery is used to get the first image for a thumbnail.
$stmt = $pdo->prepare('
    SELECT p.*, (SELECT image FROM property_images pi WHERE pi.property_id = p.id ORDER BY pi.id ASC LIMIT 1) as thumbnail
    FROM properties p
    ORDER BY p.id DESC
');
$stmt->execute();
$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate statistics for the dashboard cards.
$visibleProperties = array_filter($properties, fn($p) => !$p['hidden']);
$totalVisibleProperties = count($visibleProperties);
$totalHiddenProperties = count($properties) - $totalVisibleProperties;
$totalVisibleAmount = array_sum(array_column($visibleProperties, 'price'));

// Helper function for formatting price.
function format_admin_price($price) {
    return '$' . number_format($price, 0);
}

// Include the header after all processing is done.
include '../includes/header.php';
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <a href="admin_add_property.php" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Property</a>
    </div>

    <!-- Display success/error messages -->
    <?php
    if (isset($_SESSION['flash_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['flash_message'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['flash_message']); // Clear message after displaying.
    }
    ?>

    <!-- Stats Cards -->
    <div class="row mb-4 admin-dashboard">
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Visible Properties</h5>
                    <p class="card-text"><?php echo $totalVisibleProperties; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Hidden Properties</h5>
                    <p class="card-text"><?php echo $totalHiddenProperties; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Value (Visible)</h5>
                    <p class="card-text"><?php echo format_admin_price($totalVisibleAmount); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Properties Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($properties as $property): ?>
                            <tr class="<?php echo $property['hidden'] ? 'opacity-50' : ''; ?>">
                                <td>
                                    <img src="../assets/images/<?php echo htmlspecialchars($property['thumbnail'] ?? ''); ?>" alt="Thumb" style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;" onerror="this.onerror=null;this.src='https://placehold.co/80x60/E2F5F9/0067B1?text=N/A';">
                                </td>
                                <td class="fw-bold"><?php echo htmlspecialchars($property['title']); ?></td>
                                <td><?php echo htmlspecialchars($property['location']); ?></td>
                                <td><?php echo format_admin_price($property['price']); ?></td>
                                <td>
                                    <?php if ($property['hidden']): ?>
                                        <span class="badge bg-secondary">Hidden</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Visible</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="edit_property.php?id=<?php echo $property['id']; ?>" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <?php if ($property['hidden']): ?>
                                        <a href="index.php?action=unhide&id=<?php echo $property['id']; ?>" class="btn btn-sm btn-outline-success" title="Unhide"><i class="fas fa-eye"></i></a>
                                    <?php else: ?>
                                        <a href="index.php?action=hide&id=<?php echo $property['id']; ?>" class="btn btn-sm btn-outline-secondary" title="Hide"><i class="fas fa-eye-slash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
