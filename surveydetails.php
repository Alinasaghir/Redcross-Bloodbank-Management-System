<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redcross";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    header('Location:generalError.html');
}

// Fetch data from the view
$sql = "SELECT * FROM SURVEY_SUMMARY_VIEW";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Survey Summary</title>
    <a href="home.html">Return to Home Page</a>
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
        }

        th, td {
            text-align: left;
            padding: 8px;
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
    <h1>Survey Summary</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Feedback</th>
        </tr>
        <?php
        // Loop through the result set and display data
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["NAME"] . "</td>";
                echo "<td>" . $row["EMAIL"] . "</td>";
                echo "<td>" . $row["RATING"] . "</td>";
                echo "<td>" . $row["FEEDBACK"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No survey responses found</td></tr>";
        }
        ?>
    </table>

    <a href="admin_options.php">Return to Admin Options</a>
</body>
</html>
