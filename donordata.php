<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redcross";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ADMIN_DONOR_VIEW";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Data</title>
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
    <h1>Showing Donor's Data</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Blood Group</th>
            <th>Age</th>
            <th>Disease</th>
        </tr>
        <?php
        // Loop through the result set and display data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["USER_ID"] . "</td>";
                echo "<td>" . $row["FIRST_NAME"] . "</td>";
                echo "<td>" . $row["LAST_NAME"] . "</td>";
                echo "<td>" . $row["EMAIL"] . "</td>";
                echo "<td>" . $row["BLOOD_GROUP"] . "</td>";
                echo "<td>" . $row["AGE"] . "</td>";
                echo "<td>" . $row["DISEASE"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No donors found</td></tr>";
        }
        ?>
    </table>

    <a href="admin_options.php">Return to Admin Options</a>
</body>
</html>
