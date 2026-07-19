<?php
// Start session
session_start();

// Include database connection
include 'db.php';

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";
    if(mysqli_query($conn, $sql)){
        echo "<p style='color:green;'>✅ Registration successful. <a href='login.php'>Login here</a></p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - Zubic Academy</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; }
    .register-box { max-width:400px; margin:50px auto; background:#fff; padding:20px; border:1px solid #ccc; }
    input { width:100%; padding:10px; margin:8px 0; }
    button { background:#007BFF; color:#fff; padding:10px; border:none; cursor:pointer; }
    button:hover { background:#0056b3; }
  </style>
</head>
<body>
  <div class="register-box">
    <h2>Create Account</h2>
    <form method="post">
      <label>Name:</label><br>
      <input type="text" name="name" required><br>
      <label>Email:</label><br>
      <input type="email" name="email" required><br>
      <label>Password:</label><br>
      <input type="password" name="password" required><br>
      <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</body>
</html>