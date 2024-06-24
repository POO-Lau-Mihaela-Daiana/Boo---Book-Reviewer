<?php
$servername = "localhost";
$usernames = "root";
$password = "";
$dbname = "boo";

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli($servername, $usernames, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'message' => 'Connection failed: ' . $conn->connect_error)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['username']) || empty($_POST['username']) ||
        !isset($_POST['book_title']) || empty($_POST['book_title']) ||
        !isset($_POST['comment_text']) || empty($_POST['comment_text'])) {
        echo json_encode(['success' => false, 'error' => 'Required fields not provided']);
        exit; 
    }

    $username = $_POST['username'];
    $book_title = $_POST['book_title'];
    $comment_text = $_POST['comment_text'];

    $conn->begin_transaction();

    try {
  
        $stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_id);
        if (!$stmt->fetch()) {
            $stmt->close();
            throw new Exception("User not found with the provided name");
        }
        $stmt->close();

      
        $stmt = $conn->prepare("SELECT book_id FROM book WHERE book_title = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $book_title);
        $stmt->execute();
        $stmt->bind_result($book_id);
        if (!$stmt->fetch()) {
            $stmt->close();
            throw new Exception("Book not found with the provided title");
        }
        $stmt->close();

        
        $stmt = $conn->prepare("SELECT comment_id FROM comment WHERE user_id = ? AND comment_text = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("is", $user_id, $comment_text);
        $stmt->execute();
        $stmt->bind_result($comment_id);
        if ($stmt->fetch()) {
            $stmt->close();

            
            $stmt = $conn->prepare("DELETE FROM book_comment WHERE book_id = ? AND comment_id = ?");
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("ii", $book_id, $comment_id);
            $stmt->execute();
            $stmt->close();

            
            $stmt = $conn->prepare("DELETE FROM comment WHERE comment_id = ?");
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("i", $comment_id);
            $stmt->execute();
            $stmt->close();

            $conn->commit();
            echo json_encode(['success' => true, 'message' => 'Comment deleted successfully']);
        } else {
            $stmt->close();
            echo json_encode(['success' => false, 'error' => 'Comment not found']);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
