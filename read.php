<?php
require 'Database.php';

$database = new Database();
$db = $database->getConnection();

// Fetch all users
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();

// Display the results
echo "<table class='table'>";
echo "<thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Created At</th></tr></thead>";
echo "<tbody>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr><td>{$row['id']}</td><td>{$row['username']}</td><td>{$row['email']}</td><td>{$row['created_at']}</td></tr>";
}
echo "</tbody></table>";
?>
