<?php
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['code'])) {
    $verification_code = $_GET['code'];

    
    $check_sql = "SELECT * FROM students_user WHERE verification_code = '$verification_code'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        
        $update_sql = "UPDATE students_user SET verified = 1 WHERE verification_code = '$verification_code'";
        if (mysqli_query($conn, $update_sql)) {
            echo "Email verification successful! You can now log in.";
        } else {
            echo "Error updating verification status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid verification code.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
