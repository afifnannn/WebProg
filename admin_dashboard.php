<?php
session_start();
include('db_connect.php');
// Security Check: Only admins allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: login.php"); }

$sql = "SELECT * FROM teams";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"></head>
<body>
    <nav>
        <span>Admin Portal</span>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h2>Registered Participants</h2>
        <table>
            <tr><th>ID</th><th>Team Name</th><th>Project</th><th>Actions</th></tr>
            <?php 
            if($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['team_name']}</td>
                            <td>{$row['project_title']}</td>
                            <td>
                                <a href='edit_team.php?id={$row['id']}'>Edit</a> | 
                                <a href='delete_team.php?id={$row['id']}' style='color:red;'>Delete</a>
                            </td>
                          </tr>";
                }
            } else { echo "<tr><td colspan='4'>No data found.</td></tr>"; }
            ?>
        </table>
    </div>
</body>
</html>