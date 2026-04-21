<?php
session_start();
include('db_connect.php'); // Connecting to the 'hackathon' database

// Check if an ID was passed in the URL
if (!isset($_GET['id'])) {
    die("Error: Team ID not found.");
}

$id = $_GET['id'];

// 1. READ: Fetch current data to show in the form
$res = $conn->query("SELECT * FROM teams WHERE id = $id");
$data = $res->fetch_assoc();

// 2. UPDATE: Logic to save changes when the user clicks 'Update'
if (isset($_POST['update_btn'])) {
    $tname = $_POST['team_name'];
    $ptitle = $_POST['project_title'];
    $pdesc = $_POST['project_desc'];

    // SQL UPDATE command
    $sql = "UPDATE teams SET 
            team_name = '$tname', 
            project_title = '$ptitle', 
            project_desc = '$pdesc' 
            WHERE id = $id";

    if ($conn->query($sql)) {
        // Success: Redirect back to the dashboard
        echo "<script>alert('Team Updated Successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error; // Debugging SQL errors
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Team | Hackathon Admin</title>
</head>
<body>
    <nav>
        <span>Admin Portal</span>
        <a href="admin_dashboard.php">Dashboard</a>
    </nav>

    <div class="container">
        <a href="admin_dashboard.php" style="text-decoration: none;">← Back to Dashboard</a>
        <button class="btn" onclick="history.back()">← Back</button>
        <h2>Edit Team: <?php echo $data['team_name']; ?></h2>
        <hr>

        <form method="POST">
            <label>Team Name:</label>
            <input type="text" name="team_name" value="<?php echo $data['team_name']; ?>" required>
            
            <label>Project Title:</label>
            <input type="text" name="project_title" value="<?php echo $data['project_title']; ?>" required>
            
            <label>Project Description:</label>
            <textarea name="project_desc" rows="5"><?php echo $data['project_desc']; ?></textarea>
            
            <button type="submit" name="update_btn" class="btn">Save Changes</button>
        </form>
    </div>
</body>
</html>