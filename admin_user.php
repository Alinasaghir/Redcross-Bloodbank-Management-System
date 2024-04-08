<!DOCTYPE html>
<html>
<head>
    <title>Sorted Users</title>
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
        .toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgb(255, 0, 0); /* Updated background color */
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 9999;
            
        }
        .input {
            font-size:18px;
            display: inline-block;
            border: none;
            color: #fff;
            padding: 8px 16px;
            text-decoration: none;
            margin top: 10px;
            background-color: #4CAF50;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
<div class='heading'>
    <h1>TOTAL USERS VIEW IN SORTED MANNER</h1>
    <a href="home.html">Return to Home Page</a>
    
</div>
    </br>
    <?php
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "redcross";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch the sorted users from the view
    $sql = "SELECT * FROM USERS_SORTED_VIEW";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Blood Group</th>
                    <th>Category</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["USER_ID"] . "</td>
                    <td>" . $row["EMAIL"] . "</td>
                    <td>" . $row["FIRST_NAME"] . "</td>
                    <td>" . $row["LAST_NAME"] . "</td>
                    <td>" . $row["PHONE"] . "</td>
                    <td>" . $row["GENDER"] . "</td>
                    <td>" . $row["BLOOD_GROUP"] . "</td>
                    <td>" . $row["CATEGORY"] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No users found.</p>";
    }
    // Close the database connection
    $conn->close();
    ?>

</br>
<form id="myForm" action="refresh.php" method="post">
        <input type="submit" name="Refresh" value="Delete records before last five years" class="input">
    </form>
</br>
     <a href="admin_options.php">Return to Admin Options</a>

    <script>
    document.getElementById("myForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission

        // Display toast message
        showToast("Record Refreshed Successfully");

        // Submit the form after a certain time (e.g., 3 seconds)
        setTimeout(function () {
            event.target.submit(); // Submit the form
        }, 3000);
    });

    function showToast(message) {
        // Create a toast element
        var toast = document.createElement("div");
        toast.className = "toast";
        toast.textContent = message;

        // Append toast to the document body
        document.body.appendChild(toast);

        // Remove the toast after a certain time (e.g., 3 seconds)
        setTimeout(function () {
            toast.parentNode.removeChild(toast);
        }, 3000);
    }
</script>
</body>
</html>
