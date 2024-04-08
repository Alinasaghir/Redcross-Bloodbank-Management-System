<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "redcross";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header('Location:generalError.html');
}

// Get the current date
$currentDate = date("Y-m-d");

// Calculate the date five years ago
$fiveYearsAgo = date("Y-m-d", strtotime("-5 years", strtotime($currentDate)));

// Query to fetch user IDs registered five years ago
$sql = "SELECT user_id FROM users WHERE sys_date < '$fiveYearsAgo'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Fetch and display the user IDs
    while ($row = mysqli_fetch_assoc($result)) {
        $userID = $row['user_id'];
        
           // Check if the user ID exists in the donor table
           $sqlDonor = "SELECT user_id FROM donor WHERE user_id = '$userID'";
           $resultDonor = mysqli_query($conn, $sqlDonor);
           
           // Delete the user ID from the donor table if it exists
           if (mysqli_num_rows($resultDonor) > 0) {
               $sqlDeleteDonor = "DELETE FROM donor WHERE user_id = '$userID'";
               $resultDeleteDonor = mysqli_query($conn, $sqlDeleteDonor);
           }
             
            else {
               // Assume the user ID exists in the recipient table
               $sqlDeleteRecipient = "DELETE FROM recipient WHERE user_id = '$userID'";
               $resultDeleteRecipient = mysqli_query($conn, $sqlDeleteRecipient);
           }
       }
      }
//delete the userIds registered before last five years from users table

$sql3 = "DELETE FROM users WHERE sys_date < '$fiveYearsAgo'";
$result3 = mysqli_query($conn, $sql3);#deletes the data before the last five years

// Check if the deletion was successful
if ($result3) {
   header("location:admin_user.php");
} 
else {
    header('Location:generalError.html');
}

//Close the database connection
mysqli_close($conn);
?> 
