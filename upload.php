<?php
$uploadDirectory = 'uploads/';

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for errors
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $uploadPath = $uploadDirectory . $fileName;

        // Move the uploaded file to the desired location
        move_uploaded_file($file['tmp_name'], $uploadPath);

        // Store file details in the database
        $mysqli = new mysqli('localhost', 'root', '', 'tms_db');

        // Check connection
        if ($mysqli->connect_error) {
            die('Connection failed: ' . $mysqli->connect_error);
        }

        // Prepare and execute the INSERT query
        $query = 'INSERT INTO files (filename, filepath) VALUES (?, ?)';
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ss', $fileName, $uploadPath);
        $stmt->execute();

        // Close the mysqli connection
        $stmt->close();
        $mysqli->close();
    }
}

// Redirect back to index.php
header('Location: index.php');
exit;
?>
