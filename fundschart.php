<!DOCTYPE html>
<html>
<head>
    <title>Donation Pie Chart</title>
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
    <h1>Donation Pie Chart</h1>

    <?php
    $con = mysqli_connect("localhost", "root", "", "redcross");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $sql = "SELECT COUNT(*) as count,
        CASE
            WHEN AMOUNT < 5000 THEN 'Below 5000'
            WHEN AMOUNT >= 5000 AND AMOUNT <= 10000 THEN '5000 - 10000'
            WHEN AMOUNT > 10000 AND AMOUNT <= 50000 THEN '10000 - 50000'
            WHEN AMOUNT > 50000 THEN 'Above 50000'
            ELSE 'Other'
        END as donation_range
        FROM FUNDS
        GROUP BY donation_range";

    $result = mysqli_query($con, $sql);

    $ranges = array();
    $count = array();
    $totalCount = 0;

    while ($row = mysqli_fetch_array($result)) {
        $ranges[] = $row['donation_range'];
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

    <?php if (!empty($ranges)) { ?>
        <canvas id="myChart"></canvas>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var data = {
                labels: <?php echo json_encode($ranges); ?>,
                datasets: [{
                    data: <?php echo json_encode($percentages); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',   // Red
                        'rgba(54, 162, 235, 0.2)',   // Blue
                        'rgba(255, 206, 86, 0.2)',   // Yellow
                        'rgba(75, 192, 192, 0.2)',   // Green
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
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
