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
  <title>View Students</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

  <style>
    body {
      background: #f8f9fa;
      padding: 30px;
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
	  <div>
        <button class="btn btn-danger btn-nav" data-bs-toggle="modal" data-bs-target="#deleteAllModal">
          <i class="ri-delete-bin-2-line"></i> Delete All Students
        </button>
      <a href="javascript:history.back()" class="btn btn-secondary btn-nav">  <i class="ri-arrow-go-back-line"></i> Back </a>
        <i class="ri-arrow-go-back-line"></i> Back
      </a>
    </div>
	</div>

    <h3 class="mb-4">All Registered Students</h3>
    <div id="student-table"></div>
  </div>
<!-- Delete All Modal -->
  <div class="modal fade" id="deleteAllModal" tabindex="-1" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="deleteAllModalLabel">
            <i class="ri-error-warning-line"></i> Confirm Delete
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete <strong>all students</strong>? This action cannot be undone!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" onclick="deleteAllStudents()">Yes, Delete All</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function loadStudents() {
      fetch('fetch_students.php')
        .then(res => res.text())
        .then(data => {
          document.getElementById('student-table').innerHTML = data;
        });
    }

    function deleteStudent(id) {
      if (confirm("Are you sure you want to delete this student?")) {
        fetch('delete_student.php?id=' + id)
          .then(res => res.text())
          .then(response => {
            alert(response);
            loadStudents(); // refresh after delete
          });
      }
    }
function deleteAllStudents() {
      fetch('delete_all_students.php')
        .then(res => res.text())
        .then(response => {
          alert(response);
          loadStudents();
          const modal = bootstrap.Modal.getInstance(document.getElementById('deleteAllModal'));
          modal.hide();
        });
    }
    loadStudents();
  </script>
   <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
