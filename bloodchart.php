<?php
$con = mysqli_connect("localhost", "root", "", "redcross");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$sql = "SELECT blood_type, stock FROM bloodbag";
$result = mysqli_query($con, $sql);

$bloodTypes = array();
$quantities = array();

while ($row = mysqli_fetch_array($result)) {
    $bloodTypes[] = $row['blood_type'];
    $quantities[] = $row['stock'];
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blood Bag Chart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        canvas {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            display: inline-block;
            padding: 8px 16px;
            margin-top: 10px;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Blood Bag Stock Chart</h1>

    <?php if (!empty($bloodTypes)) { ?>
        <canvas id="myChart"></canvas>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var data = {
                labels: <?php echo json_encode($bloodTypes); ?>,
                datasets: [{
                    label: 'Stock',
                    data: <?php echo json_encode($quantities); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',   // Red
                        'rgba(54, 162, 235, 0.2)',   // Blue
                        'rgba(255, 206, 86, 0.2)',   // Yellow
                        'rgba(75, 192, 192, 0.2)',   // Green
                        'rgba(153, 102, 255, 0.2)'   // Purple
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            var options = {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Blood Type',
                            font: {
                                weight: 'bold',
                                size: 19,
                                color: 'blue'
                            }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Stock',
                            font: {
                                weight: 'bold',
                                size: 19,
                                color: 'blue'
                            }
                        },
                        beginAtZero: true
                    }
                }
            };

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        </script>
    <?php } ?>

    <a href="home.html">Return to Home Page</a>
    <br>
    <a href="admin_options.php">Return to Admin Options</a>
</body>
</html>
