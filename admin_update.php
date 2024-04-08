<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = "redcross";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $bloodType = $_POST['bloodGroup'];
    $bloodStock = $_POST['bloodStock'];

    // Validate blood stock input (positive integer)
    if (!ctype_digit($bloodStock) || intval($bloodStock) <= 0) {
        echo "Error: Blood Stock must be a positive integer.";
    } else {
        // SQL query to check if the blood type exists in the BLOODBAG table
        $query = "SELECT * FROM BLOODBAG WHERE BLOOD_TYPE = '$bloodType'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            // If blood type is found, update the stock
            $updateQuery = "UPDATE BLOODBAG SET STOCK = STOCK + $bloodStock WHERE BLOOD_TYPE = '$bloodType'";

            if (mysqli_query($conn, $updateQuery)) {
                echo "Stock updated successfully!";
            } else {
                echo "Error updating stock: " . mysqli_error($conn);
            }
        } else {
            // If blood type is not found, show error message
            echo "Error: Blood Type not found in the database.";
        }
    }
}

mysqli_close($conn);
?>
