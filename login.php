<?php
// Start session
session_start();

// Include database connection
include 'db.php';

// Handle login form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password'])){
        // Save user session
        $_SESSION['user'] = $user['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Zubic Academy</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; }
    .login-box { max-width:400px; margin:50px auto; background:#fff; padding:20px; border:1px solid #ccc; }
    input { width:100%; padding:10px; margin:8px 0; }
    button { background:#007BFF; color:#fff; padding:10px; border:none; cursor:pointer; }
    button:hover { background:#0056b3; }
    .error { color:red; }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <label>Email:</label><br>
      <input type="email" name="email" required><br>
      <label>Password:</label><br>
      <input type="password" name="password" required><br>
      <button type="submit">Login</button>
    </form>
    <p>Don’t have an account? <a href="register.php">Register here</a></p>
  </div>
</body>
</html>