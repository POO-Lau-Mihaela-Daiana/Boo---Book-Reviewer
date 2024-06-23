<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$username = $conn->real_escape_string($_POST['username']);
$user_url = $conn->real_escape_string($_POST['user_url']);
$interests = $conn->real_escape_string($_POST['interests']);
$aboutMe = $conn->real_escape_string($_POST['aboutMe']);

$sql = "UPDATE user SET username='$username', user_url='$user_url', user_description='$interests', user_tips='$aboutMe' WHERE user_id='$user_id'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating profile: ' . $conn->error]);
}

$conn->close();
?>