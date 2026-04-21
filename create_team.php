<?php
session_start();
include('db_connect.php');

if (isset($_POST['submit'])) {
    $tname = $_POST['tname'];
    $ptitle = $_POST['ptitle'];
    
    $sql = "INSERT INTO teams (team_name, project_title) VALUES ('$tname', '$ptitle')";
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php"); // Redirect after Create
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <button class="btn" onclick="history.back()">← Back</button>
    <div class="container">
        <h2>Add New Hackathon Team</h2>
        <form method="POST">
            Team Name: <input type="text" name="tname" required><br><br>
            Project Title: <input type="text" name="ptitle" required><br><br>
            <input type="submit" name="submit" value="Register Team">
        </form>
    </div>
</body>
</html>