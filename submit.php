<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Include PHPMailer autoload

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

    // Generate a 2FA verification code
    $verificationCode = rand(100000, 999999);

    // Send the 2FA code via email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use your SMTP host (e.g., Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Your email address
        $mail->Password = 'your-email-password';  // Your email password or App Password if 2FA is enabled
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email content
        $mail->setFrom('your-email@gmail.com', 'YourApp');
        $mail->addAddress($email);  // Send to user's email

        $mail->isHTML(true);
        $mail->Subject = 'Your 2FA Code';
        $mail->Body = "Use this code to complete registration: $verificationCode";

        $mail->send();
        echo '2FA Code has been sent to your email.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // Continue with storing data to the database
    require 'Database.php';

    $database = new Database();
    $db = $database->getConnection();

    // SQL query to insert user data
    $query = "INSERT INTO users (username, email, password, verification_code) VALUES (:username, :email, :password, :verification_code)";

    // Prepare and bind
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $passwordHash);
    $stmt->bindParam(":verification_code", $verificationCode);

    // Execute the query
    if ($stmt->execute()) {
        echo "User registered successfully. Please verify your email with the 2FA code.";
    } else {
        echo "Error occurred.";
    }
}
?>
