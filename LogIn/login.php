<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'Connection failed: ' . $conn->connect_error));
    exit;
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = mysqli_real_escape_string($conn, $_POST['username_or_email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT user_id, username, user_password FROM user WHERE username='$username_or_email' OR user_email='$username_or_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Debugging statements
        echo "Fetched password hash from database: " . $row['user_password'] . "<br>";
        echo "Password entered by user: " . $password . "<br>";

        if (password_verify($password, $row['user_password'])) {
            echo "Password verified successfully.<br>";
            $_SESSION['user_id'] = $row['user_id'];
            if($row['username'] == 'admin')
            header("Location: ../AdminPage/admin_page.html");
        else
            header("Location: ../MainPage/landingpage.html");
            exit;
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that username or email.";
    }
}

$conn->close();
?>
