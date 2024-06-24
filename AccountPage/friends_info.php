<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array('success' => false);

$queryFriends = "SELECT u.username, u.user_id, u.user_url FROM user u 
                 JOIN friends f ON (u.user_id = f.user_id1 OR u.user_id = f.user_id2) 
                 WHERE (f.user_id1 = $user_id) AND u.user_id != $user_id";
$resultFriends = mysqli_query($conn, $queryFriends);

$friends = array();
while ($row = mysqli_fetch_assoc($resultFriends)) {
    $friends[] = array('username' => $row['username'], 'user_id' => $row['user_id'], 'user_url' => $row['user_url']);
}

$response['friends'] = $friends;
$response['success'] = true;

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>