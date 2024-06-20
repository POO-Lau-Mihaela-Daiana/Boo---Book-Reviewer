<?php
header('Content-Type: application/json');

if (!isset($_GET['book_id'])) {
    echo json_encode(array('success' => false, 'error' => 'No book ID provided.'));
    exit;
}

$book_id = $_GET['book_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(array('success' => false, 'error' => 'Connection failed: ' . $conn->connect_error));
    exit;
}

$sql_reviews = "SELECT 
            AVG(rating) as average_rating, 
            COUNT(*) as total_reviews, 
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
        FROM book_ratings
        WHERE book_id = '$book_id'";
$result_reviews = $conn->query($sql_reviews);

if ($result->num_rows > 0) {
    $ratings = $result_reviews->fetch_assoc();
    echo json_encode(array('success' => true, 'ratings' => $ratings));
} else {
    echo json_encode(array('success' => false, 'error' => 'No ratings found for this book.'));
}

$conn->close();
?>
