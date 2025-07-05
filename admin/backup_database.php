<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: auth/login.php');
    exit();
}

include '../config/config.php';

// Database configuration
$host = 'localhost'; // Database host
$username = 'root'; // Database username
$password = ''; // Database password
$database = 'property_npl'; // Database name

// Backup directory
$backup_dir = '../backups/';
if (!file_exists($backup_dir)) {
    mkdir($backup_dir, 0777, true);
}

// Backup file name
$backup_file = $backup_dir . 'backup_' . date('Y-m-d_H-i-s') . '.sql';

// Path to mysqldump
$mysqldump = 'C:\xampp\mysql\bin\mysqldump.exe';

// Create a backup of the database
$command = "$mysqldump --host=$host --user=$username --password=$password $database > $backup_file";

// Execute the command
$output = null;
$return_var = null;
exec($command . ' 2>&1', $output, $return_var);

if ($return_var === 0) {
    echo "Database backup created successfully: $backup_file";
} else {
    echo "Error creating database backup. Command output: " . implode("\n", $output);
}
?>
