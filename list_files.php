<?php
// Establish a mysqli connection
$mysqli = new mysqli('localhost', 'root', '', 'tms_db');

// Check connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Prepare and execute the SELECT query
$query = 'SELECT * FROM files';
$result = $mysqli->query($query);

// Check if the query was successful
if (!$result) {
    die('Error in query: ' . $mysqli->error);
}

// Fetch the files
$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row;
}

// Display the list of uploaded documents
foreach ($files as $file) {
    echo '<tr>';
    echo '<td>' . $file['filename'] . '</td>';
    echo '<td><a href="download.php?file=' . $file['filename'] . '">Download</a></td>';
    echo '</tr>';
}

// Close the mysqli connection
$mysqli->close();
?>
