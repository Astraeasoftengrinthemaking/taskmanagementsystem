<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";   

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$other_gender = isset($_POST['otherGender']) ? $_POST['otherGender'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';

// Check if the email already exists in the database
$emailExistsQuery = "SELECT * FROM students_user WHERE email = '$email'";
$emailExistsResult = mysqli_query($conn, $emailExistsQuery);

if (mysqli_num_rows($emailExistsResult) > 0) {
    // Email already exists, handle accordingly (e.g., show an error message)
    echo "<script>
                 alert('Email already exists!');
                 window.location.href = 'indexmain.php';
          </script>";
} else {
    // Generate a random verification code (6 characters)
    $verification_code = substr(bin2hex(random_bytes(3)), 0, 6);

    // Send email verification
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dllgadoffice@gmail.com';
        $mail->Password   = 'hkvy ibst lyhf nbmm'; // Use app-specific password or your actual Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('dllgadoffice@gmail.com', 'Verification Code from DLL GAD');
        $mail->addAddress($email, $first_name . ' ' . $last_name);

        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body    = 'Please enter the following code to verify your email address: ' . $verification_code;

        $mail->send();

        // Insert new user with verification code
        $sql = "INSERT INTO students_user (first_name, last_name, email, password, gender, other_gender, course, verification_code, verified)
            VALUES ('$first_name', '$last_name', '$email', '$password', '$gender', '$other_gender', '$course', '$verification_code', 0)";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                var user_code = prompt('Please enter the verification code sent to your email:');
                if (user_code === '$verification_code') {
                    alert('Registration Successful!');
                    window.location.href = 'indexmain.php';
                } else {
                    alert('Incorrect verification code. Please try again.');
                    window.location.href = 'indexmain.php';
                }
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } catch (Exception $e) {
        echo "Error sending email: " . $mail->ErrorInfo;
    }
}

$conn->close();
?>
