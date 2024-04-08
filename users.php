<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redcross";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input from the user login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $category = $_POST["category"];
    $blood_group = $_POST["blood_group"];
    
    if (!preg_match('/^(03|021)/', $phone)) {
        header("location: phone_error.html");
        exit;
    }

    // Check if the combination of phone and email is unique
$check_query = "SELECT * FROM users WHERE email = '$email' AND phone = '$phone'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // The combination already exists in the users table, update the data

    // Fetch the user_id
    $fetch_query = "SELECT user_id FROM users WHERE email = '$email' AND phone = '$phone'";
    $fetch_result = $conn->query($fetch_query);

    if ($fetch_result->num_rows > 0) {
        $row = $fetch_result->fetch_assoc();
        $updateCorrespondId = $row["user_id"];

        // Store the $updateCorrespondId in a session variable
        $_SESSION['updateCorrespondId'] = $updateCorrespondId;

        // Update users table
        $updateSql = "UPDATE users SET first_name='$FName', last_name='$LName', gender='$gender', blood_group='$blood_group', category='$category' WHERE email ='$email' AND phone='$phone'";
        $conn->query($updateSql); } 
        else {
            // There was an error during the update operation
            echo "Error: " . $conn->error;
            echo "Error: Failed to update data in the users table.";
        }
    }
 else {
    // The combination is unique, proceed with inserting the user data into the users table

    // Prepare and execute the INSERT statement
    $insertSql = "INSERT INTO users (email, phone, first_name, last_name, gender, blood_group, category) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("sssssss", $email, $phone, $FName, $LName, $gender, $blood_group, $category);
    $stmt->execute();
  
     
}

}
 
if($category=='donor'){
    header("Location:donor.html");}
else{
    header("Location:recipient.html");
}    

?>