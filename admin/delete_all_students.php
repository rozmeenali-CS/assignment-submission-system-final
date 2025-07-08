<?php
include('../config.php');

$sql = "DELETE FROM users WHERE role = 'student'";
if ($conn->query($sql) === TRUE) {
    echo "✅ All students deleted successfully.";
} else {
    echo "❌ Error deleting students: " . $conn->error;
}
?>
