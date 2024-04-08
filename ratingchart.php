<!DOCTYPE html>
<html>
<head>
    <title>Rating Pie Chart</title>
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
            display: block;
            margin: 0 auto;
            max-width: 600px;
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
    <h1>Rating Pie Chart</h1>

    <?php
    $con = mysqli_connect("localhost", "root", "", "redcross");
    if (mysqli_connect_errno()) {
        header('Location:generalError.html');
        exit();
    }

    $sql = "SELECT COUNT(*) as count, RATING FROM SURVEY GROUP BY RATING";
    $result = mysqli_query($con, $sql);

    $ratings = array();
    $count = array();
    $totalCount = 0;

    while ($row = mysqli_fetch_array($result)) {
        $ratings[] = $row['RATING'];
        $count[] = $row['count'];
        $totalCount += $row['count'];
    }

    $percentages = array();
    foreach ($count as $value) {
        $percentage = round(($value / $totalCount) * 100, 2);
        $percentages[] = $percentage;
    }

    mysqli_close($con);
    ?>

    <?php if (!empty($ratings)) { ?>
        <canvas id="myChart"></canvas>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var data = {
                labels: <?php echo json_encode($ratings); ?>,
                datasets: [{
                    data: <?php echo json_encode($percentages); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',   // Red
                        'rgba(54, 162, 235, 0.2)',   // Blue
                        'rgba(255, 206, 86, 0.2)',   // Yellow
                        'rgba(75, 192, 192, 0.2)',   // Green
                        'rgba(153, 102, 255, 0.2)',  // Purple
                        'rgba(255, 159, 64, 0.2)',   // Orange
                        'rgba(128, 0, 0, 0.2)',      // Maroon
                        'rgba(0, 128, 0, 0.2)',      // Green
                        'rgba(128, 128, 0, 0.2)',    // Olive
                        'rgba(0, 0, 128, 0.2)'       // Navy
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(128, 0, 0, 1)',
                        'rgba(0, 128, 0, 1)',
                        'rgba(128, 128, 0, 1)',
                        'rgba(0, 0, 128, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            var options = {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.formattedValue + '%';
                                return label;
                            }
                        }
                    }
                }
            };

            var myChart = new Chart(ctx, {
                type: 'pie',
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
