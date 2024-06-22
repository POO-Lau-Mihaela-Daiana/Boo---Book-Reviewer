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
    // Check if user_id is provided in POST data
    if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
        echo json_encode(['success' => false, 'error' => 'User ID not provided']);
        exit; // Stop script execution
    }

    $user_id = $_POST['user_id'];

    $conn->begin_transaction();

    try {
     
        $stmt = $conn->prepare("DELETE FROM comment WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();

      
        $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
