<?php
// Assuming you have a database connection
include 'db_connect.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Get the friend's username from the form
$friendUsername = $_POST['friendUsername'];

// Add friend logic
if (!empty($friendUsername)) {
    // Check if the friend exists in the database
    $checkFriendQuery = "SELECT * FROM students_user WHERE email = '$friendUsername'";
    $checkFriendResult = mysqli_query($connection, $checkFriendQuery);

    if ($checkFriendResult && mysqli_num_rows($checkFriendResult) > 0) {
        // Friend exists, add them to the user's friend list
        $currentUser = $_SESSION['email'];
        $addFriendQuery = "INSERT INTO friends (user1, user2) VALUES ('$currentUser', '$friendUsername')";
        mysqli_query($connection, $addFriendQuery);

        // You can add additional logic or redirect the user to a success page
    } else {
        // Friend does not exist, handle accordingly (e.g., show an error message)
    }
}

// Close the database connection
mysqli_close($connection);
?>
