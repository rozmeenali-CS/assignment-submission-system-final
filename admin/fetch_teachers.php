<?php
include('../config.php');

$result = $conn->query("SELECT * FROM users WHERE role = 'teacher' ORDER BY created_at DESC");

echo "<table class='table table-bordered table-striped'>";
echo "<thead><tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Signup Date</th>
        <th>Action</th>
      </tr></thead><tbody>";

$count = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$count}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['department']}</td>
            <td>{$row['created_at']}</td>
            <td><i class='ri-delete-bin-line' onclick='deleteTeacher({$row['id']})'></i></td>
          </tr>";
    $count++;
}
echo "</tbody></table>";
