<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$book_id = isset($_POST['book_id']) ? $_POST['book_id'] : null;
$list_number = isset($_POST['list_number']) ? $_POST['list_number'] : null;

if (!$book_id || !$list_number) {
    echo json_encode(['error' => 'Missing book_id or list_number']);
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}


$sql = "SELECT * FROM library WHERE user_id = ? AND book_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
   
    $sql = "UPDATE library SET list_number = ? WHERE user_id = ? AND book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $list_number, $user_id, $book_id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Book status updated']);
    } else {
        echo json_encode(['error' => 'Update failed: ' . $stmt->error]);
    }
} else {
    
    $sql = "INSERT INTO library (user_id, book_id, list_number) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $book_id, $list_number);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Book status added']);
    } else {
        echo json_encode(['error' => 'Insert failed: ' . $stmt->error]);
    }
}

$conn->close();
?>