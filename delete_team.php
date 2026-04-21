<?php
session_start();
include('db_connect.php');
if ($_SESSION['role'] === 'admin' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM teams WHERE id=$id"); // Execute Delete
}
header("Location: admin_dashboard.php");
?>