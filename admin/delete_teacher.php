<?php
include('../config.php');
$id = $_GET['id'];

if ($conn->query("DELETE FROM users WHERE id = $id AND role = 'teacher'")) {
    echo "Teacher deleted successfully.";
} else {
    echo "Failed to delete teacher.";
}
