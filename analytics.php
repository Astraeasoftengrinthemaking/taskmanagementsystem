<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration Charts</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(rgba(255, 192, 203, 0.9), rgba(173, 216, 230, 0.9)), url('background.jpg') center/cover no-repeat fixed;
    }

    .chart-container {
        width: 48%;
        margin: 10px;
        float: left;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }

    .chart {
        max-width: 100%;
        height: auto;
        border-radius: 15px;
        overflow: hidden;
    }
</style>

<body>
    <div class="chart-container">
        <canvas id="userChart1" class="chart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="userChart2" class="chart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="userChart3" class="chart"></canvas>
    </div>

    <?php

    $hostname = "localhost";
    $username = "root";
    $password = "";  
    $database = "tms_db";  
    
    
    $conn = new mysqli($hostname, $username, $password, $database);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql1 = "SELECT gender, COUNT(*) as count FROM consultation_records GROUP BY gender";
    $sql2 = "SELECT course, COUNT(*) as count FROM consultation_records GROUP BY course";
    $sql3 = "SELECT year, COUNT(*) as count FROM consultation_records GROUP BY year";

    
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);

    
    $userData1 = array('Male' => 0, 'Female' => 0);
    $userData2 = array();
    $userData3 = array();

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $userData1[$row['gender']] = $row['count'];
        }
    }

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $userData2[$row['course']] = $row['count'];
        }
    }

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $userData3[$row['year']] = $row['count'];
        }
    }
    ?>

    <script>
        // Display the first chart
        const userData1 = <?php echo json_encode($userData1); ?>;
        const userChartCanvas1 = document.getElementById('userChart1').getContext('2d');
        new Chart(userChartCanvas1, {
            type: 'bar',
            data: {
                labels: Object.keys(userData1),
                datasets: [{
                    label: 'User Count',
                    data: Object.values(userData1),
                    backgroundColor: ['#3498db', '#e74c3c'], 
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
        const userData2 = <?php echo json_encode($userData2); ?>;
        const userChartCanvas2 = document.getElementById('userChart2').getContext('2d');
        new Chart(userChartCanvas2, {
            type: 'bar',
            data: {
                labels: Object.keys(userData2),
                datasets: [{
                    label: 'Course Count',
                    data: Object.values(userData2),
                    backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6', '#34495e'], // Colors for courses
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
        const userData3 = <?php echo json_encode($userData3); ?>;
        const userChartCanvas3 = document.getElementById('userChart3').getContext('2d');
        new Chart(userChartCanvas3, {
            type: 'bar',
            data: {
                labels: Object.keys(userData3),
                datasets: [{
                    label: 'Year Count',
                    data: Object.values(userData3),
                    backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6', '#34495e'], // Colors for years
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
