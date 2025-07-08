<?php
$host = getenv("DB_HOST");       // e.g., sql12.freesqldatabase.com
$user = getenv("DB_USER");       // e.g., sql12788907
$pass = getenv("DB_PASS");       // e.g., DDm6w5mAJu
$db   = getenv("DB_NAME");       // e.g., sql12788907

$conn = new mysqli($host, $user, $pass, $db);

// Admin credentials — set securely or hardcoded (optional)
$admin_email = "admin@example.com";
$admin_password = "admin123";  // You can hash this if needed

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
