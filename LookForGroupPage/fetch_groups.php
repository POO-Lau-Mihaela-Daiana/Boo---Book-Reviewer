<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Fetch groups the user is in
$sql = "SELECT g.group_id, g.name, g.description 
        FROM groups g 
        JOIN user_group ug ON g.group_id = ug.group_id 
        WHERE ug.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$current_groups = $result->fetch_all(MYSQLI_ASSOC);

// Fetch groups the user is not in
$sql = "SELECT g.group_id, g.name, g.description 
        FROM groups g 
        WHERE g.group_id NOT IN (
            SELECT group_id 
            FROM user_group 
            WHERE user_id = ?
        )";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$open_groups = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode(['success' => true, 'current_groups' => $current_groups, 'open_groups' => $open_groups]);

$stmt->close();
$conn->close();
?>