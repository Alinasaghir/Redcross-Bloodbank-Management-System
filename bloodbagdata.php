<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redcross";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the view
$sql = "SELECT * FROM ADMIN_BLOODBAG_VIEW";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blood Bag View</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            text-align: left;
            padding: 12px 20px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
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
</head>
<body>
    <h1>Blood Bag View</h1>

    <table>
        <tr>
            <th>Blood Type</th>
            <th>Blood ID</th>
            <th>Stock</th>
        </tr>
        <?php
        // Loop through the result set and display data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["BLOOD_TYPE"] . "</td>";
                echo "<td>" . $row["BLOOD_ID"] . "</td>";
                echo "<td>" . $row["STOCK"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No blood bags found</td></tr>";
        }
        ?>
    </table>

    <a href="home.html">Return to Home Page</a>
    <br>
    <a href="admin_options.php">Return to Admin Options</a>
</body>
</html>
