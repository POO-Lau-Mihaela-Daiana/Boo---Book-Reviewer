<?php
header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$user_id = $_SESSION['user_id'];

$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$sql = "";

switch ($category) {
    case 'want_to_read':
        $sql = "SELECT b.* FROM library l JOIN book b ON l.book_id = b.book_id WHERE l.user_id = $user_id AND l.list_number = 1";
        break;
    case 'currently_reading':
        $sql = "SELECT b.* FROM library l JOIN book b ON l.book_id = b.book_id WHERE l.user_id = $user_id AND l.list_number = 2";
        break;
    case 'read':
        $sql = "SELECT b.* FROM library l JOIN book b ON l.book_id = b.book_id WHERE l.user_id = $user_id AND l.list_number = 3";
        break;
    case 'all':
    default:
        $sql = "SELECT b.* FROM library l JOIN book b ON l.book_id = b.book_id WHERE l.user_id = $user_id";
        break;
}

$result = $conn->query($sql);

if (!$result) {
    echo json_encode(array('error' => 'Query failed: ' . $conn->error));
    $conn->close();
    exit;
}

$books = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

$conn->close();

if (count($books) === 1) {
    echo json_encode($books[0]);
} else {
    echo json_encode($books);
}
?>