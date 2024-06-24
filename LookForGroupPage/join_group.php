<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $group_id = $_POST['group_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "boo";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO user_group (user_id, group_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $group_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Successfully joined the group.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error joining group.']);
    }

    $stmt->close();
    $conn->close();
}
?>