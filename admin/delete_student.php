<?php
include('../config.php');
$id = $_GET['id'];

if ($conn->query("DELETE FROM users WHERE id = $id AND role = 'student'")) {
    echo "Student deleted successfully.";
} else {
    echo "Failed to delete student.";
}
