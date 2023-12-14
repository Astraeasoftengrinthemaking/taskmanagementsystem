<?php

use Dompdf\Dompdf;
use Dompdf\Options;

// Include DOM Pdf autoload file
require_once 'vendor/autoload.php';

// Use the existing database connection
$conn = new mysqli('localhost', 'root', '', 'tms_db') or die("Could not connect to MySQL: " . mysqli_error($conn));

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mi = $_POST["mi"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $year = $_POST["year"];
    $course = $_POST["course"];
    $gender = $_POST["gender"];
    $orient = $_POST["orient"];
    $comments = $_POST["comments"];

    // Prepare the SQL query using prepared statements
    $query = "INSERT INTO consultation_records (fname, lname, mi, email, address, year, course, gender, orient, comments) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Use the existing connection variable $conn
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind parameters and execute
        $stmt->bind_param("ssssssssss", $fname, $lname, $mi, $email, $address, $year, $course, $gender, $orient, $comments);

        // Execute the query
        $stmt->execute();

        // Get last insert id
        $last_id = $stmt->insert_id;

        // Get last insert data
        $sql = "SELECT * FROM consultation_records WHERE id = '$last_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        // Instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');

        $dompdf->setOptions($options);

    $html = '<style>
        .container{
            width: 750px;
            text-align: center;
        }
        #customers {
            border-collapse: collapse;
            width: 595px;
            margin-left: auto;
            margin-right: auto;
        }

        #customers td, #customers th {
          border: 1px solid #ddd;
          padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}
        #customers th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          color: #000;
        }
    </style>
    <div class="container">
        <h1>Convert HTML to PDF In PHP with Dompdf</h1>
        <table id="customers">
            <tbody>
                <tr>
                    <th>First Name</th>
                    <td>'.$fname.'</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>'.$lname.'</td>
                </tr>
                <tr>
                    <th>Middle Initial</th>
                    <td>'.$mi.'</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>'.$email.'</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>'.$address.'</td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td>'.$year.'</td>
                </tr>
                <tr>
                    <th>Course</th>
                    <td>'.$course.'</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>'.$gender.'</td>
                </tr>
                <tr>
                    <th>Sexual Orientation</th>
                    <td>'.$orient.'</td>
                </tr>
                <tr>
                    <th>Comments</th>
                    <td>'.$comments.'</td>
                </tr>
            </tbody>
        </table>
    </div>';

// Load content from html file 
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF (1 = download and 0 = preview) 
$dompdf->stream("webscodex_".$last_id,  array("Attachment" => 1));

$stmt->close();
    } else {
        // Handle the case where the prepared statement fails
        echo "Error preparing SQL statement: " . $conn->error;
    }
}
?>