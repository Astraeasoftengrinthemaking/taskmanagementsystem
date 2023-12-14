<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gender and Development Projects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('background.jpg') center/cover no-repeat fixed;
        }

        header {
            background-color: rgba(0, 0, 255, 0.7);
            color: #fff;
            text-align: center;
            padding: 1em 0;
            backdrop-filter: blur(10px);
        }

        section {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .back-btn {
            display: inline-block;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            position: absolute;
            bottom: 10px;
            left: 10px;
            backdrop-filter: blur(5px);
        }

        .project-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .project {
            width: 300px;
            margin: 15px;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease-in-out;
            backdrop-filter: blur(5px);
        }

        .project:hover {
            transform: scale(1.05);
        }

        .project img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
        }

        .project-caption {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        <h1>Gender and Development Projects</h1>
    </header>

    <section>
        <div class="project-container">
            <!-- Project 1 -->
            <div class="project">
                <img src="safe space tarp.jpg" alt="Project 1">
                <div class="project-caption">
                    <h3>Safe Space</h3>
                    <p>At Pacific Mall Lucena City, a safe space for gender rights is depicted—a vibrant hub where diverse individuals engage in open dialogue and celebration. Colorful displays and informative materials set the tone for inclusivity, making this venue a beacon of progress and acceptance</p>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="project">
                <img src="22.jpg" alt="Project 2">
                <div class="project-caption">
                    <h3>Safe Space</h3>
                    <p>Description of Project 2.</p>
                </div>
            </div>

            <div class="project">
                <img src="21.jpg" alt="Project 2">
                <div class="project-caption">
                    <h3>Safe Space</h3>
                    <p>Description of Project 2.</p>
                </div>
            </div>

            <!-- Add more projects as needed -->
        </div>

        <!-- Back Button -->
        <a href="indexmain.php" class="back-btn">Back</a>
    </section>

</body>
</html>
