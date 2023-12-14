<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f1f1f1;
        }

        .background-image {
            position: fixed;
            width: 100%;
            height: 100%;
            background: url('bg4.jpg') no-repeat center center fixed;
            background-size: cover;
            filter: blur(5px);
            z-index: -1;
        }

        .signup-form {
            max-width: 400px;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(5px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .signup-form h2 {
            margin-bottom: 20px;
        }

        .signup-form input[type="text"],
        .signup-form input[type="email"],
        .signup-form input[type="password"],
        .signup-form select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            margin-bottom: 16px;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .signup-form input[type="text"][name="otherGender"] {
            display: none;
        }

        .signup-form select[name="gender"],
        .signup-form select[name="course"] {
            margin-bottom: 16px;
        }

        .signup-form input[type="text"][name="otherGender"].active {
            display: block;
        }

        .signup-form button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .signup-form button:hover {
            opacity: 0.8;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: space-between;
        }

        .form-group input,
        .form-group select {
            width: 48%;
        }
    </style>
</head>

<body>
    <div class="background-image"></div>
    <div class="signup-form">
        <h2>Sign Up</h2>
        <form action="signup_connect.php" method="post">
            <div class="form-group">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
            </div>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="form-group">
                <select name="gender" required onchange="showOther(this.value)">
                    <option value="" disabled selected>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                <input type="text" name="otherGender" placeholder="Specify your gender" class="active">
            </div>
            <select name="course" required>
                <option value="" disabled selected>Department</option>
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
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <script>
        function showOther(value) {
            var otherGenderInput = document.querySelector('input[name="otherGender"]');
            if (value === 'other') {
                otherGenderInput.classList.add('active');
            } else {
                otherGenderInput.classList.remove('active');
            }
        }
    </script>
</body>

</html>
