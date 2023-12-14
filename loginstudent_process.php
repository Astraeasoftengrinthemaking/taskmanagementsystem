<?php
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";  
// Attempt to connect to the database
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // SQL injection prevention
    $safe_email = $conn->real_escape_string($email);
    $safe_password = $conn->real_escape_string($password);

    // Query the database to find a matching user
    $query = "SELECT * FROM students_user WHERE email='$safe_email' AND password='$safe_password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // If the credentials are correct, redirect to the index page
        header("Location: user_dashboardprocess.php");
        exit();
    } else {
        // If the credentials are incorrect, display an error message
        echo "<script>
        alert('Invalid username or password.'); 
        window.location.href = 'login_student.php';
    </script>";
    }
}

// Close the connection
$conn->close();
?>
