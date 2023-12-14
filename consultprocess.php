<?php
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";   

$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = isset($_POST['fname']) ? $_POST['fname'] : '';
$lname = isset($_POST['lname']) ? $_POST['lname'] : '';
$mi = isset($_POST['mi']) ? $_POST['mi'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';
$course = isset($_POST['course']) ? $_POST['course'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$comments = isset($_POST['comments']) ? $_POST['comments'] : '';


// SQL query to insert data into the database
$sql = "INSERT INTO consultation_records (fname, lname, mi, email, year, course, gender, comments)
        VALUES ('$fname', '$lname', '$mi', '$email', '$year', '$course', '$gender', '$comments')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Registration Successful!'); 
        window.location.href = 'indexmain.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
// Close the database connection
$conn->close();
?>
