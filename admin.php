<?php
// Database credentials
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

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        header("Location: admin_options.php");
        exit;
    } else {
        // Invalid login
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Admin Login</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f1f1f1;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                }

                .container {
                    max-width: 400px;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }

                h1 {
                    margin-top: 0;
                }

                p {
                    margin-bottom: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Invalid Credentials</h1>
                <p>Please try again.</p>
                <p>We will be redirecting you to the admin login page after 7 seconds.</p>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "admin.html";
                }, 7000);
            </script>
        </body>
        </html>
        ';
        exit;
    }
}
$conn->close();
?>
