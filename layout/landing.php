<?php
session_start();


if (!isset($_SESSION['username'])) {
    
    header("Location: index.php");
    exit;
}


$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="lead">You have successfully signed in.</p>

        
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">User Profile</h5>
                <p class="card-text">Username: <?php echo htmlspecialchars($username); ?></p>
                
            </div>
        </div>

        
        <div class="mt-4">
            <a href="read.php" class="btn btn-primary">View All Users</a>
            
        </div>
    </div>
</body>
</html>
