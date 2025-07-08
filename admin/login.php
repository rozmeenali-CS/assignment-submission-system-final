<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == $admin_email && $password == $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <!-- Remix Icon (for cool icons) -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

  <style>
    body {
      background: linear-gradient(135deg, #1e3c72, #2a5298);
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      animation: popUp 1s ease;
    }

    @keyframes popUp {
      0% { transform: scale(0.8); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: bold;
      color: #1e3c72;
      position: relative;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    .form-group input {
      padding-left: 40px;
      border-radius: 12px;
    }

    .form-group i {
      position: absolute;
      top: 50%;
      left: 12px;
      transform: translateY(-50%);
      font-size: 20px;
      color: #1e3c72;
    }

    .btn-login {
      width: 100%;
      border-radius: 12px;
      background: #1e3c72;
      color: #fff;
      font-weight: bold;
      transition: 0.3s ease;
    }

    .btn-login:hover {
      background: #163159;
      transform: scale(1.05);
    }

    .error-msg {
      color: red;
      text-align: center;
      margin-top: 15px;
    }

    @media(max-width: 576px) {
      .login-box {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2><i class="ri-shield-user-line"></i> Admin Login</h2>
    <form method="POST">
      <div class="form-group">
        <i class="ri-mail-line"></i>
        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
      </div>
      <div class="form-group">
        <i class="ri-lock-2-line"></i>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-login">Login <i class="ri-arrow-right-line"></i></button>
 <?php if(isset($error)): ?>
        <p class="error-msg"><?= $error ?></p>
      <?php endif; ?>
    </form>
	<div class="text-center mt-4">
  <a href="../index.php" class="btn btn-outline-primary" style="border-radius: 12px; padding: 10px 25px; font-weight: 500;">
    <i class="ri-home-4-line"></i> Go to Home
  </a>
</div>
  </div>

</body>
</html>
