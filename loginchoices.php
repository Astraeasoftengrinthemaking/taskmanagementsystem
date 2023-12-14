<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #ff6ec4, #7873f5); /* Pink to Blue gradient */
        }

        .login-box {
            width: 400px; /* Adjusted width */
            text-align: center;
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white background for frosted glass effect */
            border-radius: 10px;
            padding: 20px;
            backdrop-filter: blur(10px); /* Frosted glass effect */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow for depth */
        }

        .login-option {
            margin-bottom: 10px;
        }

        .login-option a {
            display: block;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .login-option a:hover {
            background-color: #45a049;
        }
    </style>
    <title>Login Page</title>
</head>

<body>
    <div class="login-box">
        <h2>Please log in as:</h2>
        <div class="login-option">
            <a href="login_student.php">User</a>
        </div>
        <div class="login-option">
            <a href="login.php">Admin/Staff</a>
        </div>
    </div>
</body>

</html>
