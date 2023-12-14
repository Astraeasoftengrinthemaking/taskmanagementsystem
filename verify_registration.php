<?php
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";   

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $verification_code = isset($_POST['verification_code']) ? $_POST['verification_code'] : '';

 
    $check_sql = "SELECT * FROM students_user WHERE verification_code = '$verification_code' AND status = 'pending'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
       
        $update_sql = "UPDATE students_user SET status = 'verified' WHERE verification_code = '$verification_code'";
        if (mysqli_query($conn, $update_sql)) {
            echo "<script>
                alert('Email verification successful! You can now log in to your account.'); 
                window.location.href = 'indexmain.php';
            </script>";
        } else {
            echo "Error updating user status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid verification code. Please check the code and try again.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h2>Enter Verification Code</h2>
    <form method="post" action="">
        <label for="verification_code">Verification Code:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
