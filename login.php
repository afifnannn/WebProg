<?php
session_start(); // Start session to track the user
include('db_connect.php'); // Connect to the 'hackathon' database

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // In your lab, we use plain text

    // Query to find the user in the 'users' table
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Setting Session variables for security and role management
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // 'admin' or 'user'

        // Redirect based on the role defined in the database
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_profile.php");
        }
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login | Hackathon EMS</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <nav>
        <span><strong>HackerDash</strong></span>
        <a href="index.php">Home</a>
    </nav>

    <div class="container" style="max-width: 400px; margin-top: 100px;">
        <h2>Login</h2>
        
        <?php if($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p>Don't have an account? Contact your Admin.</p>
    </div>
</body>
</html>