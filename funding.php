<?php
// Establish a database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "redcross";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = ($_POST["annonymous"] == 'yes') ? 'anonymous' : mysqli_real_escape_string($conn, $_POST["name"]);
    $email = ($_POST["annonymous"] == 'yes') ? 'anonymous' : mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = ($_POST["annonymous"] == 'yes') ? '0' : mysqli_real_escape_string($conn, $_POST["phone"]);
    $amount = mysqli_real_escape_string($conn, $_POST["amount"]);
    $payment = mysqli_real_escape_string($conn, $_POST["source"]);
    $sponsor = ($_POST["annonymous"] == 'yes') ? 'null' : mysqli_real_escape_string($conn, $_POST["sponsor"]);
    $feedback = mysqli_real_escape_string($conn, $_POST["feedback"]);

    // Validate phone number
    if ($_POST["annonymous"] != 'yes' && !preg_match("/^(03|021)/", $phone)) {
        header("location: phone_error.html");
        exit;
    }

    if ($_POST["annonymous"] == 'yes') {
        // Check if anonymous fund exists
        $query = "SELECT * FROM funds WHERE email='anonymous' AND phone='0'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Anonymous fund exists, update the existing record
            $sql = "UPDATE funds SET amount = amount + '$amount' WHERE email='anonymous' AND phone='0'";
        } else {
            // Anonymous fund does not exist, insert a new record
            $sql = "INSERT INTO funds (name,email, phone, amount, payment_opt, sponsor, message) VALUES ('anonymous','anonymous', '0', '$amount', '$payment', NULL, '$feedback')";
        }
    }else {
        // Validate phone number for non-anonymous users
        if (!preg_match("/^(03|021)/", $phone)) {
            header("location: phone_error.html");
            exit;
        }
    
        // Convert amount to a numeric value
        $amount = (float) $amount;
    
        // Use the INSERT INTO ... ON DUPLICATE KEY UPDATE syntax
        $sql = "INSERT INTO funds (name,email, phone, amount, payment_opt, sponsor, message)
                VALUES ('$name','$email', '$phone', $amount, '$payment', '$sponsor', '$feedback')
                ON DUPLICATE KEY UPDATE amount = amount + $amount, payment_opt = '$payment', sponsor = '$sponsor', message = '$feedback'";
    }
if (mysqli_query($conn, $sql)) {
        header("Location:fundSubmitted.html");
     } else {
        header("location: generalError.html");
        }
    mysqli_close($conn);
}
?>
