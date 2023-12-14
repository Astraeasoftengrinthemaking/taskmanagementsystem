<?php
// ajax.php

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'get_projects':
        echo json_encode(getProjectsFromDatabase());
        break;

    // Add other cases for different actions if needed

    default:
        break;
}

function getProjectsFromDatabase() {
    // Replace this with your actual database connection logic
    $conn= new mysqli('localhost','root','','tms_db');


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $projects = array();

    // Replace this with your actual query to fetch projects from the database
    $result = $conn->query("SELECT id, name, start_date, end_date FROM projects");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
                'start_date' => $row['start_date'],
                'end_date' => $row['end_date']
            );
        }
    }

    $conn->close();

    return $projects;
}
?>
