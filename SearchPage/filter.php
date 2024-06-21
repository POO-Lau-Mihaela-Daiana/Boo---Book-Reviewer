<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'Connection failed: ' . $conn->connect_error));
    exit;
}

if(isset($_POST['filter'])) {

   
    $sql_filter = "SELECT book.book_id, book.book_title, book.book_author, book.book_description, book.book_photo_url 
                   FROM book 
                   JOIN 
                   genre_book on genre_book.book_id=book.book_id
                   JOIN 
                   genre on genre_book.genre_id=genre.genre_id
                   WHERE genre.genre_name=?";

   
    $stmt = $conn->prepare($sql_filter);

    $stmt->bind_param('s', $filter);

    $stmt->execute();

    $result = $stmt->get_result();

  
    if ($result->num_rows > 0) {
        $filterResults = array();

        while ($row = $result->fetch_assoc()) {
            $filterResults[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode(array('success' => true, 'search' => $filterResults));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'message' => 'No books found.'));
    }

    $stmt->close();
} else {
  
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'message' => 'No filter query provided.'));
}

$conn->close();
?>

