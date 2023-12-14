<?php
if (isset($_GET['file'])) {
    $filename = $_GET['file'];

    // Establish a mysqli connection
    $mysqli = new mysqli('localhost', 'root', '', 'tms_db');

    // Check connection
    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    // Prepare and execute the SELECT query
    $stmt = $mysqli->prepare('SELECT * FROM files WHERE filename = ?');
    $stmt->bind_param('s', $filename);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch the file record
    $file = $result->fetch_assoc();

    // Check if the file exists
    if ($file) {
        $filepath = 'uploads/' . $file['filename']; // Change this path to the actual path where your files are stored.

        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    } else {
        echo 'File not found.';
    }

    // Close the mysqli connection
    $stmt->close();
    $mysqli->close();
} else {
    echo 'Invalid request.';
}
?>
