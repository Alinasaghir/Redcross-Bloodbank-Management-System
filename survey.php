<?php
// Establish a database connection
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$dbname = "redcross";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $dbname);

if (!$conn) {
    header('Location:generalError.html');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = ($_POST["annonymous"] == 'yes') ? 'anonymous' : mysqli_real_escape_string($conn, $_POST["name"]);
    $email = ($_POST["annonymous"] == 'yes') ? 'anonymous' : mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = ($_POST["annonymous"] == 'yes') ? '0' : mysqli_real_escape_string($conn, $_POST["phone"]);
    $address = ($_POST["annonymous"] == 'yes') ? 'Unknown' : mysqli_real_escape_string($conn, $_POST['address']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    // Validate phone number if not anonymous
    if ($_POST["annonymous"] != 'yes' && !preg_match("/^(03|021)/", $phone)) {
        header("location: phone_error.html");
        exit;
    }

    $sql = ""; // Initialize $sql variable

    if ($_POST["annonymous"] == 'yes') {
        // Check if anonymous survey exists
        $query = "SELECT * FROM survey WHERE email='anonymous' AND phone='0'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Anonymous survey exists, update the existing record
            $sql = "UPDATE survey SET rating = ((rating * total_responses) + '$rating') / (total_responses + 1), total_responses = total_responses + 1 WHERE email='anonymous' AND phone='0'";
        } else {
            // Anonymous survey does not exist, insert a new record
            $sql = "INSERT INTO survey (name, email, phone, address, rating, feedback, total_responses) VALUES ('$name', 'anonymous', '0', 'Not provided', '$rating', '$feedback', 1)";
        }
    } else {
        // Validate phone number for non-anonymous user
        if (!preg_match("/^(03|021)/", $phone)) {
            header("location:phone_error.html");
            exit;
        }
        $existing_survey_query = "SELECT * FROM survey WHERE email='$email'";
        $existing_survey_result = mysqli_query($conn, $existing_survey_query);

        // Insert data into database
        if (mysqli_num_rows($existing_survey_result) > 0) {
            // User's email exists, update the existing record
            $update_query = "UPDATE survey SET name='$name', phone='$phone', address='$address', rating='$rating', feedback='$feedback' WHERE email='$email'";
            if (mysqli_query($conn, $update_query)) {
                header("location:surveySubmitted.html");
                exit;
            } else {
                header('Location:generalError.html');
            }
        } else {
            // User's email does not exist, insert a new record
            $insert_query = "INSERT INTO survey (name, email, phone, address, rating, feedback, total_responses) VALUES ('$name', '$email', '$phone', '$address','$rating', '$feedback', 1)";
            if (mysqli_query($conn, $insert_query)) {
                header("location:surveySubmitted.html");
                exit;
            } else {
                header('Location:generalError.html');
            }
        }
    }

    }

    if (!empty($sql) && mysqli_query($conn, $sql)) {
        header("location:surveySubmitted.html");
    } else {
        header("location: generalError.html");
    }

    mysqli_close($conn);
?>