<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>View Teachers</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

  <style>
    body {
      background: #f8f9fa;
      padding: 30px;
    }
    .card {
      border-radius: 12px;
    }
    .ri-delete-bin-line {
      color: red;
      cursor: pointer;
    }
    .btn-nav {
      margin-bottom: 20px;
      border-radius: 8px;
      font-weight: 500;
    }
    .btn-nav i {
      margin-right: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Navigation Buttons -->
    <div class="d-flex justify-content-between mb-4">
      <a href="dashboard.php" class="btn btn-primary btn-nav">
        <i class="ri-dashboard-line"></i> Go to Dashboard
      </a>
      <a href="javascript:history.back()" class="btn btn-secondary btn-nav">
        <i class="ri-arrow-go-back-line"></i> Back
      </a>
	  <!-- Delete All Teachers Button -->
<button class="btn btn-danger btn-nav" data-bs-toggle="modal" data-bs-target="#deleteAllModal">
  <i class="ri-delete-bin-7-line"></i> Delete All Teachers
</button>

    </div>

    <h3 class="mb-4">All Registered Teachers</h3>
    <div id="teacher-table"></div>
  </div>

  <script>
    function loadTeachers() {
      fetch('fetch_teachers.php')
        .then(res => res.text())
        .then(data => {
          document.getElementById('teacher-table').innerHTML = data;
        });
    }

    function deleteTeacher(id) {
      if (confirm("Are you sure you want to delete this teacher?")) {
        fetch('delete_teacher.php?id=' + id)
          .then(res => res.text())
          .then(response => {
            alert(response);
            loadTeachers(); // refresh after delete
          });
      }
    }

    loadTeachers();
	function deleteAllTeachers() {
  fetch('delete_all_teachers.php')
    .then(res => res.text())
    .then(response => {
      alert(response);
      var modal = bootstrap.Modal.getInstance(document.getElementById('deleteAllModal'));
      modal.hide(); // close modal
      loadTeachers(); // reload table
    });
}

  </script>
  <!-- Delete All Confirmation Modal -->
<div class="modal fade" id="deleteAllModal" tabindex="-1" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteAllModalLabel"><i class="ri-error-warning-line"></i> Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete <strong>all registered teachers</strong>? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
        <button type="button" class="btn btn-danger" onclick="deleteAllTeachers()">Yes, Delete All</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
