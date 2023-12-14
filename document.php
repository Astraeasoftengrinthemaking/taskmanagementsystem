<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLL GAD Documents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: linear-gradient(135deg, #3498db, #e74c3c);
            background-size: 400% 400%;
            animation: gradientAnimation 15s infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        h1 {
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        form {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            color: black;
            margin-bottom: 10px;
        }

        input {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        button:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            color: white;
        }

        th {
            background-color: rgba(255, 255, 255, 0.3);
        }

        a {
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>DLL GAD Documents</h1>

    <!-- Form for uploading documents -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select a file to upload:</label>
        <input type="file" name="file" id="file">
        <button type="submit" name="submit">Upload</button>
    </form>

    <!-- Table for listing uploaded documents -->
    <table>
        <tr>
            <th>File Name</th>
            <th>Download</th>
        </tr>
        <?php include 'list_files.php'; ?>
    </table>

    <script>
        // You can add JavaScript code here if needed
    </script>

</body>
</html>
