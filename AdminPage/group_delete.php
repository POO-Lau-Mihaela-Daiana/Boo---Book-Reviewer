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
   
    if (!isset($_POST['group_id']) || empty($_POST['group_id'])) {
        echo json_encode(['success' => false, 'error' => 'Group ID not provided']);
        exit; 
    }

    $group_id = $_POST['group_id'];

    $conn->begin_transaction();

    try {
     
        $stmt = $conn->prepare("DELETE FROM user_group WHERE group_id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $group_id);
        $stmt->execute();
        $stmt->close();

      
        $stmt = $conn->prepare("DELETE FROM groups WHERE group_id = ?");
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $group_id);
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
