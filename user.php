<?php
session_start();
// Security Check: Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
}
include('db_connect.php');

$user_id = $_SESSION['user_id'];
// Read: Fetching ONLY this specific user's data
$sql = "SELECT * FROM users JOIN teams ON users.team_id = teams.id WHERE users.id = '$user_id'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<html>
<body>
    <h1>Your Hackathon Profile</h1>
    <p><strong>Name:</strong> <?php echo $data['name']; ?></p>
    <p><strong>Your Team:</strong> <?php echo $data['team_name']; ?></p>
    
    <a href="update_project.php">Update Project Description</a> 
    <br><br>
    <a href="logout.php">Logout</a>
</body>
</html>