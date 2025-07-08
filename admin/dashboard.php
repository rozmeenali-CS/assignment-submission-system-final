<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include('../config.php');

// Dummy data — replace with SQL counts later
$totalTeachers = 12;
$totalStudents = 120;
$assignmentCounts = [2, 5, 7, 4, 9, 3, 6]; // dummy weekly data
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  
  <!-- Remix Icon -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
  
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    body {
      background: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
      overflow-x: hidden;
    }

    .sidebar {
      width: 220px;
      background: #1e3c72;
      height: 100vh;
      position: fixed;
      top: 0; left: 0;
      padding-top: 50px;
      color: #fff;
      transition: 0.3s ease;
    }

    .sidebar a {
      display: block;
      padding: 15px 25px;
      color: #fff;
      text-decoration: none;
      transition: 0.3s ease;
    }

    .sidebar a:hover {
      background: #163159;
    }

    .sidebar i {
      margin-right: 10px;
    }

    .main {
      margin-left: 220px;
      padding: 30px;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      transition: 0.3s ease;
    }

    .card:hover {
      transform: scale(1.02);
    }

    .card-icon {
      font-size: 30px;
      color: #1e3c72;
    }

    .graph-section {
      margin-top: 40px;
    }

    .btn-view {
      border-radius: 10px;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        height: auto;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
      }
      .main {
        margin-left: 0;
        padding-top: 120px;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
  <h4 class="text-center">Admin Panel</h4>
  <a href="#"><i class="ri-dashboard-line"></i> Dashboard</a>
  <a href="view_teachers.php"><i class="ri-team-line"></i> View Teachers</a>
  <a href="view_students.php"><i class="ri-user-3-line"></i> View Students</a>
  <a href="logout.php"><i class="ri-logout-box-line"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="main">
  <div class="container-fluid">
    <h2 class="mb-4">Welcome, Admin</h2>

    <!-- Stats Cards -->
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card p-4 text-center">
          <i class="ri-team-fill card-icon"></i>
          <h5>Total Teachers</h5>
          <h3 id="teacher-count"><?= $totalTeachers ?></h3>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card p-4 text-center">
          <i class="ri-user-fill card-icon"></i>
          <h5>Total Students</h5>
          <h3 id="student-count"><?= $totalStudents ?></h3>
        </div>
      </div>
    </div>

    <!-- Graph Section -->
    <div class="graph-section mt-5">
      <h4>Weekly Assignment Uploads</h4>
      <canvas id="assignmentChart" height="100"></canvas>
    </div>

    <!-- Buttons -->
    <div class="mt-5">
      <a href="view_teachers.php" class="btn btn-primary btn-view me-3">
        <i class="ri-eye-line"></i> View All Teachers
      </a>
      <a href="view_students.php" class="btn btn-success btn-view">
        <i class="ri-eye-line"></i> View All Students
      </a>
    </div>
  </div>
</div>

<script>
let assignmentChart;

function fetchDashboardData() {
  fetch('dashboard_data.php')
    .then(res => res.json())
    .then(data => {
      document.getElementById('teacher-count').innerText = data.teachers;
      document.getElementById('student-count').innerText = data.students;

      // Update or create chart
      if (assignmentChart) {
        assignmentChart.data.datasets[0].data = data.assignments;
        assignmentChart.update();
      } else {
        const ctx = document.getElementById('assignmentChart').getContext('2d');
        assignmentChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
            datasets: [{
              label: 'Assignments',
              data: data.assignments,
              backgroundColor: '#1e3c72',
              borderRadius: 10
            }]
          },
          options: {
            responsive: true,
            scales: {
              y: { beginAtZero: true }
            }
          }
        });
      }
    });
}

// Call on page load
fetchDashboardData();

// Auto refresh every 10 seconds
setInterval(fetchDashboardData, 10000);
</script>

</body>
</html>
