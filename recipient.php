<?php
session_start(); // Start the session

// Retrieve the user_id from the query parameter or session
$updateCorrespondId = $_SESSION['updateCorrespondId'];

// Create a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "redcross";

$conn = new mysqli($servername, $username, $password, $database);
// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// #retrieving input from recipient login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST['quantity'];
    $cost = 2200 * $quantity;

    // Retrieve the last inserted user_id from the users table
    $sql = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];
    }

    // Function to check if the user_id exists in the recipient table
    function isUserIdExistsInRecipientTable($conn, $userId)
    {
        $sql = "SELECT user_id FROM recipient WHERE user_id = '$userId'";
        $result = $conn->query($sql);
        return $result->num_rows > 0;
    }

    // Check if the user_id starts with "R-" and doesn't exist in the recipient table
    if (substr($userId, 0, 2) === 'R-' && !isUserIdExistsInRecipientTable($conn, $userId)) {
        // Insert the user_id into the recipient table
        $insertSql = "INSERT INTO recipient (user_id, quantity, cost_Rs) VALUES ('$userId', '$quantity', '$cost')";

        if ($conn->query($insertSql) === TRUE) {
            header("Location: receiverSubmitted.html");
        } else {
            echo "Error inserting user ID into recipient table: " . $conn->error;
        }
    } else {
        // Update the recipient table
        $updateSql = "UPDATE recipient SET quantity = '$quantity', cost_Rs = '$cost' WHERE user_id = '$updateCorrespondId'";
        if ($conn->query($updateSql) === TRUE) {
            header("Location: receiverSubmitted.html");
        } else {
            echo "Error updating recipient information: " . $conn->error;
        }
    }
}
?>
