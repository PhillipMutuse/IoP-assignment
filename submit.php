<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Input validation
  $username = trim($_POST['username']);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = $_POST['password'];

 
