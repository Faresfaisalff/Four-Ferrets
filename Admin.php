<?php
// admin_comments.php
session_start();

// Simple admin authentication
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "username", "password", "comments_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the comments from the database
$sql = "SELECT client_name, client_comment FROM comments";
$result = $conn->query($sql);

echo "<h1>Client Comments</h1>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>" . $row["client_name"] . ":</strong> " . $row["client_comment"] . "</p>";
    }
} else {
    echo "No comments yet.";
}

$conn->close();
?>
