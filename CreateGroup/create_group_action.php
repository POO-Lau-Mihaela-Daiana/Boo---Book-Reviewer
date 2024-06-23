<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

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

    // Insert group into groups table
    $stmt = $conn->prepare("INSERT INTO groups (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    if ($stmt->execute()) {
        $group_id = $stmt->insert_id;

        // Insert user into user_group table
        $stmt = $conn->prepare("INSERT INTO user_group (user_id, group_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $group_id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Group created successfully.', 'group_id' => $group_id]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding user to group.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error creating group.']);
    }

    $stmt->close();
    $conn->close();
}
?>