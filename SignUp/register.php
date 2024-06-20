<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password != $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $check_sql = "SELECT * FROM user WHERE username='$username' OR user_email='$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Username or email already exists.";
        exit;
    }

    // Insert the new user into the database
    $sql = "INSERT INTO user (username, user_email, user_password) VALUES ('$username', '$email', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. Password hash: $hashed_password"; // Debug output
        header("Location: ../MainPage/landingpage.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
