<?php
session_start();
include('db_connect.php');

// 1. Security: Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// 2. Read: Fetch the team details for this specific user
// Note: This query assumes the team_name or user_id is linked to the registration
$sql = "SELECT * FROM teams WHERE team_name = (SELECT team_name FROM users_teams WHERE user_id = '$user_id') LIMIT 1";
// For simplicity in this draft, we'll fetch a team where the name matches a registered value
$sql = "SELECT * FROM teams ORDER BY id DESC LIMIT 1"; 
$result = $conn->query($sql);
$team_data = ($result && $result->num_rows > 0) ? $result->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile | Hackathon 2026</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>

    <nav>
        <span><strong>HackerDash</strong> Participant</span>
        <div>
            <a href="user_profile.php">My Team</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
        <h2>Welcome back, <?php echo htmlspecialchars($username); ?>!</h2>
        <hr>

        <?php if ($team_data): ?>
            <div class="profile-card" style="border-left: 5px solid #3498db; padding: 20px; background: #f9f9f9;">
                <h3>Team: <?php echo $team_data['team_name']; ?></h3>
                <p><strong>Project Title:</strong> <?php echo $team_data['project_title']; ?></p>
                <p><strong>Description:</strong> <?php echo $team_data['project_desc']; ?></p>
                <p><strong>Status:</strong> <span style="color: #27ae60; font-weight: bold;">Registered</span></p>
                
                <br>
                <a href="update_project.php?id=<?php echo $team_data['id']; ?>" class="btn">Update Project Info</a>
            </div>
        <?php else: ?>
            <div class="profile-card">
                <p>You haven't joined a team yet.</p>
                <a href="register_team.php" class="btn">Register Your Team</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>