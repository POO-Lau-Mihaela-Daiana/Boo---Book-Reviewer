<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$current_user_id = $_SESSION['user_id'];
$other_user_id = isset($_POST['other_user_id']) ? $_POST['other_user_id'] : '';

$response = array('success' => false, 'message' => '');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $response['message'] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit;
}

if ($other_user_id && $current_user_id != $other_user_id) {
    $checkFriendship = $conn->prepare("SELECT * FROM friends WHERE (user_id1 = ? AND user_id2 = ?) OR (user_id1 = ? AND user_id2 = ?)");
    $checkFriendship->bind_param("iiii", $current_user_id, $other_user_id, $other_user_id, $current_user_id);
    $checkFriendship->execute();
    $result = $checkFriendship->get_result();

    if ($result->num_rows > 0) {
        $response['message'] = "You are already friends.";
    } else {
        $addFriend = $conn->prepare("INSERT INTO friends (user_id1, user_id2) VALUES (?, ?)");
        $addFriend->bind_param("ii", $current_user_id, $other_user_id);
        if ($addFriend->execute()) {
            $response['success'] = true;
            $response['message'] = "Friend added successfully.";
        } else {
            $response['message'] = "Error adding friend: " . $conn->error;
        }
        $addFriend->close();
    }
    $checkFriendship->close();
} else {
    $response['message'] = "Invalid user ID.";
}

$conn->close();
echo json_encode($response);
?>