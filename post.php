<?php
session_start();

//$randomPostId = md5(uniqid());

$dbHost = "localhost";
$dbUser = 'root';
$dbPass = '';
$dbName = 'testing';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$randomPostId = $_GET['id']; // Assuming you pass the ID through the URL

$sql = "SELECT * FROM posts WHERE post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $randomPostId);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// Display the post
if ($post) {
    echo "<h1>{$post['title']}</h1>";
    echo "<p>{$post['content']}</p>";
} else {
    echo "Post not found.";
}

// Close the database connection
$stmt->close();
$conn->close();
