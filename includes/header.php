<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Determine the base URL for assets and links to handle paths correctly
$base_url = '';
// Check if the current script is in the 'admin' directory
if (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) {
    $base_url = '../';
}

// Function to check if a navigation link is active
function isActive($path) {
    // Compare the base name of the server script with the provided path
    return basename($_SERVER['SCRIPT_NAME']) == $path ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RHB Property NPL</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/styles.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo $base_url; ?>assets/images/icon/favicon_01.ico">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand" href="<?php echo $base_url; ?>index.php">
                <img src="<?php echo $base_url; ?>assets/images/icon/logo.webp" alt="RHB Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'admin'): ?>
                        <!-- Admin Navigation -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('index.php'); ?>" href="<?php echo $base_url; ?>admin/index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('admin_add_property.php'); ?>" href="<?php echo $base_url; ?>admin/admin_add_property.php">Add Property</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $base_url; ?>index.php" target="_blank">View Site</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $base_url; ?>admin/auth/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <!-- Public Navigation -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('index.php'); ?>" href="<?php echo $base_url; ?>index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActive('contact_us.php'); ?>" href="<?php echo $base_url; ?>contact_us.php">Contact Us</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="<?php echo $base_url; ?>admin/auth/login.php"><i class="fas fa-user-lock"></i> Admin</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <main>
