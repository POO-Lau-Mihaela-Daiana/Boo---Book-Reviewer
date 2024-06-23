<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

if (!isset($_GET['group_id'])) {
    echo json_encode(['success' => false, 'message' => 'Group ID is missing.']);
    exit;
}

$group_id = $_GET['group_id'];

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

// Fetch comments by group members
$sql = "SELECT c.comment_id, c.comment_text, b.book_id, b.book_title, u.user_id, u.username, u.user_url 
FROM comment c 
JOIN book_comment bc ON c.comment_id = bc.comment_id
JOIN book b ON bc.book_id = b.book_id 
JOIN user u ON c.user_id = u.user_id 
WHERE c.user_id IN (SELECT user_id FROM user_group WHERE group_id = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$result = $stmt->get_result();
$group_activity = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'group_activity' => $group_activity]);
?>