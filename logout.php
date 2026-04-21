<?php
session_start();
session_destroy(); // Safely clear all user data
header("Location: index.php"); // Redirect back to home
exit();
?>