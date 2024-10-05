<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Input validation
  $username = trim($_POST['username']);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = $_POST['password'];

  if (empty($username) || !$email || empty($password)) {
    die("Please fill in all fields and provide a valid email.");
  }

  // Password hashing for security
  $passwordHash = password_hash($password, PASSWORD_BCRYPT);

  // Continue with storing data to the database
}
?>
