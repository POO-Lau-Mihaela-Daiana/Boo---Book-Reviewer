<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'error' => 'Connection failed: ' . $conn->connect_error)));
}

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(array('success' => false, 'error' => 'User not logged in.'));
    exit;
}

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);

    $sql_user = "SELECT username, user_url,user_date_of_creation,user_description,user_tips FROM user WHERE user_id=?";
    $stmt_user = $conn->prepare($sql_user);

    if ($stmt_user === false) {
        die(json_encode(array('success' => false, 'error' => 'Prepare statement failed: ' . $conn->error)));
    }

    $stmt_user->bind_param("i", $user_id);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user === false || $result_user->num_rows === 0) {
        $stmt_user->close();
        $conn->close();
        die(json_encode(array('success' => false, 'error' => 'Invalid user ID or query error: ' . $conn->error)));
    }

    $user = $result_user->fetch_assoc();

    $sql_groups = "SELECT groups.name FROM groups JOIN user_group ON groups.group_id = user_group.group_id WHERE user_group.user_id=?";
    $stmt_groups = $conn->prepare($sql_groups);

    if ($stmt_groups === false) {
        die(json_encode(array('success' => false, 'error' => 'Prepare statement failed: ' . $conn->error)));
    }

    $stmt_groups->bind_param("i", $user_id);
    $stmt_groups->execute();
    $result_groups = $stmt_groups->get_result();

    $groups = [];
    while ($row = $result_groups->fetch_assoc()) {
        $groups[] = $row['name'];
    }

    $stmt_groups->close();
    $stmt_user->close();
    $conn->close();

    echo json_encode(array('success' => true, 'user' => $user, 'groups' => $groups));
} else {
    echo json_encode(array('success' => false, 'error' => 'No user ID provided.'));
}

?>