<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(array('success' => false, 'error' => 'User not logged in.'));
    exit;
}

if (!isset($_POST['book_id'], $_SESSION['user_id'], $_POST['comment'])) {
    echo json_encode(array('success' => false, 'error' => 'Incomplete data received.'));
    exit;
}

$book_id = $_POST['book_id'];
$user_id = $_SESSION['user_id'];
$comment = $_POST['comment'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(array('success' => false, 'error' => 'Connection failed: ' . $conn->connect_error));
    exit;
}


$comment = $conn->real_escape_string($comment);


$sql = "INSERT INTO comment (comment_text, user_id) VALUES ('$comment', '$user_id')";
if ($conn->query($sql) === TRUE) {
    $comment_id = $conn->insert_id;


    $sql = "INSERT INTO book_comment (book_id, comment_id) VALUES ('$book_id','$comment_id')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true, 'message' => 'Comment added successfully.'));
    } else {
        echo json_encode(array('success' => false, 'error' => 'Error inserting into book_comment table: ' . $conn->error));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Error inserting into comments table: ' . $conn->error));
}

$conn->close();
?>
