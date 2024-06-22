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
    $book_id = $_POST['book_id'];
   
    $conn->begin_transaction();

    try {

        $stmt = $conn ->prepare("DELETE FROM book_rating WHERE book_id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn ->prepare("DELETE FROM book_genre WHERE book_id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();


        $stmt = $conn ->prepare("DELETE FROM book_comment WHERE book_id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();

     
        $stmt = $conn ->prepare("DELETE FROM comment WHERE comment_id IN (SELECT comment_id FROM book_comment WHERE book_id = ?)");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn ->prepare("DELETE FROM book_rating WHERE book_id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();

        $stmt = $conn->prepare("DELETE FROM book_genre WHERE book_id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();

        
        $stmt = $conn ->prepare("DELETE FROM book WHERE book_id = ?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $stmt->close();

      
        $conn ->commit();

       
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn ->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    $conn ->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Book ID not provided']);
}
?>