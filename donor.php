<?php
session_start(); // Start the session

// Retrieve the updateCorrespondId from the session
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

// Retrieve donor-specific details from the donor's form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST['age'];
    $disease = $_POST['disease'];

    // Query to retrieve the last inserted user ID of the 'donor' category
    $sql = "SELECT user_id FROM users WHERE category = 'donor' ORDER BY user_id DESC LIMIT 1";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();
        $lastDonorID = $row['user_id'];

        // Function to check if the user_id exists in the donor table
        function isUserIdExistsInDonorTable($conn, $lastDonorID) {
            $sql = "SELECT user_id FROM donor WHERE user_id = '$lastDonorID'";
            $result = $conn->query($sql);
            return $result->num_rows > 0;
        }

        // Check if the user_id doesn't exist in the donor table
        if (!isUserIdExistsInDonorTable($conn, $lastDonorID) && $disease == 'None') {
            // Insert the user_id into the donor table
            $insertSql = "INSERT INTO donor (user_id, age, disease) VALUES ('$lastDonorID', '$age', '$disease')";
            if ($conn->query($insertSql) === TRUE) {
                header("Location: donorSubmitted.html");
                exit();
            } else {
                echo "Error inserting user ID into donor table: " . $conn->error;
            }
        } elseif ($disease != 'None') {
            echo "You are ineligible!";
            
            // Delete the record from the users table
            $deleteSql = "DELETE FROM users WHERE user_id = '$lastDonorID'";
            if ($conn->query($deleteSql) === TRUE) {
                header('Location:Ineligible.html');
            } else {
                header('Location:generalError.html');
            }
        } else {    
            // Query to check if the user_id exists in the donor table
            $checkSql = "SELECT user_id FROM donor WHERE user_id = '$updateCorrespondId'";
            $checkResult = $conn->query($checkSql);

            if ($checkResult && $checkResult->num_rows > 0) {
                // Update the donor table
                $updateSql = "UPDATE donor SET age = '$age', disease = '$disease' WHERE user_id = '$updateCorrespondId'";
                if ($conn->query($updateSql) === TRUE) {
                    header("Location: donorSubmitted.html");
                    exit();
                } else {
                    echo "Error updating donor information: " . $conn->error;
                }
            }
        }
    }
}

// Close the database connection
$conn->close();
?>
