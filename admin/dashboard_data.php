<?php
include('../config.php');

// Total Teachers
$teachers = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'teacher'");
$totalTeachers = $teachers->fetch_assoc()['total'];

// Total Students
$students = $conn->query("SELECT COUNT(*) as total FROM users WHERE role = 'student'");
$totalStudents = $students->fetch_assoc()['total'];

// Assignments Count per day (last 7 days)
$data = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $result = $conn->query("SELECT COUNT(*) as total FROM assignments WHERE DATE(created_at) = '$date'");
    $count = $result->fetch_assoc()['total'];
    $data[] = $count;
}

echo json_encode([
    'teachers' => $totalTeachers,
    'students' => $totalStudents,
    'assignments' => $data
]);
