<?php
include('db_connect.php');
if (isset($_POST['submit'])) {
    $tname = $_POST['team_name'];
    $ptitle = $_POST['project_title'];
    $pdesc = $_POST['project_desc'];
    // Insert: Form data into the 'teams' table
    $sql = "INSERT INTO teams (team_name, project_title, project_desc) VALUES ('$tname', '$ptitle', '$pdesc')";
    if ($conn->query($sql)) { echo "<script>alert('Registration Successful!'); window.location='index.php';</script>"; }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <div class="container">
        <button class="btn" onclick="history.back()">← Back</button>
        <h2>Team Registration Form</h2>
        <form method="POST">
            <input type="text" name="team_name" placeholder="Enter Team Name" required>
            <input type="text" name="project_title" placeholder="Project Title" required>
            <textarea name="project_desc" placeholder="Briefly describe your project"></textarea>
            <button type="submit" name="submit" class="btn">Submit Entry</button>
        </form>
    </div>
</body>
</html>