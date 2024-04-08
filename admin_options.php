<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            display: block;
            padding: 10px;
            background-color: #f9f9f9;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
        }

        a:hover {
            background-color: #e0e0e0;
        }

        .return-button {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .return-button button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .return-button button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Administrator!</h1>
        <h2>Please select an operation:</h2>
        <ul>
            <li><a href="admin_user.php">View Users in a sorted manner</a></li>
            <li><a href="donordata.php">View Donors</a></li>
            <li><a href="recipientdata.php">View Recipients</a></li>
            <li><a href="surveydetails.php">View Survey Details</a></li>
            <li><a href="admin_funds.php">View Funds Details</a></li>
            <li><a href="admin_anony.php">View Anonymous Users</a></li>
            <li><a href="fundschart.php">View chart of Funds</a></li>
            <li><a href="admincontact.php">View Contact page information</a></li>
            <li><a href="ratingchart.php">View chart of Ratings</a></li>
            <li><a href="bloodchart.php">View chart of Blood</a></li>
            <li><a href="admin_update.html">Update Blood Record Manually</a></li>
            <li><a href="bloodbagdata.php">See Blood Stock</a></li>
        </ul>
    </div>
    <div class="return-button">
        <button onclick="window.location.href='home.html'">Return to Home Page</button>
    </div>
</body>
</html>
