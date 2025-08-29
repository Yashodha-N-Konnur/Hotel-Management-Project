<?php
// db.php - MySQL connection for XAMPP
// Create database 'hotel' via phpMyAdmin or the provided SQL file.
// Update username/password if different.

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'hotel';

// Connect using mysqli
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check connection
if ($conn->connect_errno) {
    echo "<h3>Database connection failed:</h3>";
    echo "<p>Please create a MySQL database named <strong>hotel</strong> and run the SQL file <code>create_tables.sql</code> found in the project root. Then refresh this page.</p>";
    echo "<pre>MySQLi connect error: " . htmlspecialchars($conn->connect_error) . "</pre>";
    exit;
}
// $conn is now available to other scripts
?>
