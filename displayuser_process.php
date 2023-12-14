<?php
// Assuming you have a database connection file
include 'db_connect.php';
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";   


// Connect to the database
$conn = new mysqli($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch users from the database
$sql = "SELECT first_name,last_name,email,gender,course FROM students_user";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching users: " . mysqli_error($conn));
}

$users = array();

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($users);
?>
