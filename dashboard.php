<?php
session_start();
if(!isset($_SESSION['user'])){
  header("Location: login.php");
  exit;
}
?>
<h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
<p>You are successfully enrolled in Zubic Academy courses.</p>
<a href="logout.php">Sign Out</a>