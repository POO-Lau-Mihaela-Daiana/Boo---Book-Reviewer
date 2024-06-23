<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_GET['user_id']; // Get the user ID from the query parameters

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

$sql = "SELECT b.book_id, b.book_title, b.book_photo_url
        FROM book b
        JOIN library l ON b.book_id = l.book_id
        WHERE l.user_id = $user_id AND l.list_number = 2";

$result = $conn->query($sql);
$currentlyReadingBooks = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $currentlyReadingBooks[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($currentlyReadingBooks);
?>