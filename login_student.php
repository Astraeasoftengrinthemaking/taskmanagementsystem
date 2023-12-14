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
            background: linear-gradient(to right, #ff6b6b, #34ace0);
        }

        .login-box {
            width: 300px;
            text-align: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            box-sizing: border-box;
            color: #fff;
        }

        .login-box input[type="submit"] {
            width: 100%;
            background: linear-gradient(to right, #ff6b6b, #34ace0);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-box input[type="submit"]:hover {
            background: linear-gradient(to right, #ff6363, #2c8ef6);
        }

        h2 {
            color: #fff;
        }
    </style>
    <title>Student Login</title>
</head>

<body>
    <div class="login-box">
        <h2>Student Login</h2>
        <form action="loginstudent_process.php" method="post">
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="submit" value="Log In">
        </form>
    </div>
</body>

</html>
