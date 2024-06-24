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
   
    if (!isset($_POST['comment_id']) || empty($_POST['comment_id'])) {
        echo json_encode(['success' => false, 'error' => 'Comment ID not provided']);
        exit; 
    }

    $comment_id = $_POST['comment_id'];

    $conn->begin_transaction();

    try {
     
        $stmt = $conn->prepare("DELETE FROM book_comment WHERE comment_id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $comment_id);
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
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
