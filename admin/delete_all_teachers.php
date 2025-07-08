<?php
session_start();
include('../config.php');

if (!isset($_SESSION['admin'])) {
    echo "Unauthorized access!";
    exit();
}

$sql = "DELETE FROM users WHERE role = 'teacher'";
if ($conn->query($sql)) {
    echo "All teachers deleted successfully.";
} else {
    echo "Error deleting teachers.";
}
?>
