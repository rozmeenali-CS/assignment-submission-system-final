<?php
session_start();

// Destroy all admin-related session variables
session_unset();
session_destroy();

// Redirect to home page
header("Location: ../index.php");
exit();
?>
