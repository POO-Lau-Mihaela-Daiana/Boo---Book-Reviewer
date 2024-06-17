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
    $bookId = $_POST['bookId'];
   
    $mysqli->begin_transaction();

    try {

        $stmt = $mysqli->prepare("DELETE FROM book_comment WHERE book_id = ?");
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $stmt->close();

     
        $stmt = $mysqli->prepare("DELETE FROM comments WHERE comment_id IN (SELECT comment_id FROM book_comment WHERE book_id = ?)");
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $stmt->close();

        
    
        $stmt = $mysqli->prepare("DELETE FROM books WHERE book_id = ?");
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        $stmt->close();

      
        $mysqli->commit();

       
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
      
        $mysqli->rollback();
      
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }


    $mysqli->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Book ID not provided']);
}
?>