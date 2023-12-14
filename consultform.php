<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gender and Development Consultation</title>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 70%;
            margin: auto;
            overflow: hidden;
            padding: 10px;
            background-color: #fff;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 8px;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .print-button {
            background-color: #008CBA;
        }

        .print-button:hover {
            background-color: #005580;
        }
    </style>

</head>
<body>


    <div class="modal-dialog modal-dialog-scrollable">
    <h2>Gender and Development Consultation Form</h2>
    <form action="print_consultform.php" method="post" onsubmit="return printForm()">

        <label for="name">First Name:</label>
        <input type="text" id="name" name="fname" required>

        <label for="name">Last Name:</label>
        <input type="text" id="name" name="lname" required>

        <label for="name">Middle Initial:</label>
        <input type="text" id="name" name="mi" required>

        <label for="name">Email:</label>
        <input type="email" id="name" name="email" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required></textarea>

        <label for="year">Year:</label>
        <select id="year" name="year" required>
            <option value="" disabled selected>Year</option>
            <option value="First Year">First Year</option>
            <option value="Second Year">Second Year</option>
            <option value="Third Year">Third Year</option>
            <option value="Fourt Year">Fourth Year</option>
        </select>

        <label for="course">Course:</label>
        <select id="course" name="course" required>
        <option value="" disabled selected>Course/Department</option>
            <option value="BSIT">Bachelor of Science in Information Technology</option>
            <option value="BSPA">Bachelor of Science in Public Administration</option>
            <option value="BSA">Bachelor of Science in Accountancy</option>
            <option value="BSAIS">Bachelor of Science in Accounting Information System</option>
            <option value="BSSW">Bachelor of Science in Social Work</option>
            <option value="BSE">Bachelor of Science in Entrepreneurship</option>
            <option value="ABELS">Bachelor of Arts in English Language Studies</option>
            <option value="DHRS">Diploma in Hotel Restaurant Services</option>
            <option value="BTVTEd">Bachelor of Technical-Vocational Teacher Education</option>
        </select>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>

        <label for="name">Sexual Orientation:</label>
        <input type="text" id="orient" name="orient" required>

        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" rows="4" required></textarea>

        <button type="submit" onclick="printForm()">Submit</button>
        <button type="button" onclick="goBack()">Back</button>
</div>

<script>
    function goBack() {
        window.location.href = 'user_dashboardprocess.php';
    }

    function printForm() {
        // Create a new jsPDF instance
        var pdf = new jsPDF();

        // Select the modal content to convert to PDF
        var element = document.querySelector('.modal-dialog');

        // Create the PDF using html2pdf
        html2pdf(element)
            .from(element)
            .set({
                margin: 10,
                filename: 'consultation_form.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            })
            .outputPdf();

        // Prevent the form from submitting
        return false;
    }

    // Validate form function (assuming you have it)
    function validateForm() {
        // Your validation logic goes here
        return true; // Return true if validation passes
    }
</script>

</body>
</html>
