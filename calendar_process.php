<?php
// Replace with your actual database connection details
$hostname = "localhost";
$username = "root";
$password = "";  
$database = "tms_db";  

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the requested year and month from the query parameters
$requestedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
$requestedMonth = isset($_GET['month']) ? $_GET['month'] : date('n');

// Fetch events from the database for the specified month and year
$sql = "SELECT DAY(start_date) as day, DATE_FORMAT(start_date, '%c') as month, DATE_FORMAT(start_date, '%Y') as year, name FROM project_list WHERE YEAR(start_date) = $requestedYear AND MONTH(start_date) = $requestedMonth";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

// Close the connection
$conn->close();

// Return events as JSON
header('Content-Type: application/json');
echo json_encode($events);
?>
