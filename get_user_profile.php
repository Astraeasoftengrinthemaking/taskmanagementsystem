<?php


// Database connection details
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";   

// Create connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get user ID from the POST request
$userId = $_POST['user_id'];

// Fetch user data and posts from the database
$sql = "SELECT * FROM users WHERE id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $userData = $result->fetch_assoc();

  // Fetch user posts
  $sqlPosts = "SELECT * FROM posts WHERE user_id = $userId";
  $resultPosts = $conn->query($sqlPosts);
  $userData['posts'] = [];

  if ($resultPosts->num_rows > 0) {
    while ($post = $resultPosts->fetch_assoc()) {
      $userData['posts'][] = $post;
    }
  }
} else {
  $userData = ['error' => 'User not found'];
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($userData);

// Close the connection
$conn->close();
?>
