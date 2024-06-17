<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";


error_reporting(E_ALL);
ini_set('display_errors', 1);


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'message' => 'Connection failed: ' . $conn->connect_error)));
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookPhoto = $_POST['bookPhoto'];
    $bookName = $_POST['bookName'];
    $bookAuthor = $_POST['bookAuthor'];
    $bookDescription = $_POST['bookDescription'];
    $bookPages = intval($_POST['bookPages']);
    $bookPublisher = $_POST['bookPublisher'];
    $bookPublicationDate = $_POST['bookPublicationDate'];

   
    $stmt = $conn->prepare("INSERT INTO book (book_photo_url, book_title, book_author, book_description, book_pages, book_publisher, book_publication) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die(json_encode(array('success' => false, 'message' => 'Prepare statement failed: ' . $conn->error)));
    }

    $stmt->bind_param("ssssiss", $bookPhoto, $bookName, $bookAuthor, $bookDescription, $bookPages, $bookPublisher, $bookPublicationDate);

    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Book added successfully'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Execute failed: ' . $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}

$conn->close();
?>
