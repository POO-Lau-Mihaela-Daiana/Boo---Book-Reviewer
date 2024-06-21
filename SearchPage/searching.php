<?php
session_start();

// Check if user is not logged in, redirect to login page
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

if(isset($_POST['search'])) {

    $search = '%' . $conn->real_escape_string($_POST['search']) . '%';

   
    $sql_search = "SELECT book_id, book_title, book_author, book_description, book_photo_url 
                   FROM book 
                   WHERE book_title LIKE ?";

   
    $stmt = $conn->prepare($sql_search);

    $stmt->bind_param('s', $search);

    $stmt->execute();

    $result = $stmt->get_result();

  
    if ($result->num_rows > 0) {
        $searchResults = array();

        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode(array('success' => true, 'search' => $searchResults));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'message' => 'No books found.'));
    }

    $stmt->close();
} else {
  
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'message' => 'No search query provided.'));
}

$conn->close();
?>

