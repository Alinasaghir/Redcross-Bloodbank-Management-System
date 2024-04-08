<?php
// Establish a database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$dbname = "redcross";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    // Validate phone number starting with "03" or "02"
    if (!preg_match('/^(03|021)/', $phone)) {
        header("location: phone_error.html");
        exit;
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO questions (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        header("location: contactSubmitted.html");
    } else {
        // Failed to insert data
        header("location: generalError.html");
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
mysqli_close($conn);
?>
