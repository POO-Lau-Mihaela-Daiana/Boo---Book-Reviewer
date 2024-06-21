<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(array('success' => false, 'error' => 'User not logged in.'));
    exit;
}

if (!isset($_POST['book_id'], $_SESSION['user_id'], $_POST['rating'])) {
    echo json_encode(array('success' => false, 'error' => 'Incomplete data received.'));
    exit;
}

$book_id = $_POST['book_id'];
$user_id = $_SESSION['user_id'];
$rating = intval($_POST['rating']);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(array('success' => false, 'error' => 'Connection failed: ' . $conn->connect_error));
    exit;
}

if (isset($_POST['book_id']) && isset($_POST['rating'])&& isset($_SESSION['user_id'])) {
    $book_id = $conn->real_escape_string($_POST['book_id']);

    $check_sql = "SELECT * FROM book_rating WHERE book_id = ? AND user_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $book_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(array('success' => false, 'message' => 'You have already reviewed this book.'));
    } else {
            $book_rating_sql = "INSERT INTO book_rating (book_id, rating,user_id) VALUES (?, ?,?)";
            $stmt = $conn->prepare($book_rating_sql);
            $stmt->bind_param("iii", $book_id, $rating, $user_id);
            $stmt->execute();
    
            echo json_encode(array('success' => true, 'message' => 'Review added successfully.'));
     }//else {
    //     echo json_encode(array('success' => false, 'error' => 'Error adding rating: ' . $stmt->error));
    // }
}
    
    $stmt->close();

$conn->close();
?>
