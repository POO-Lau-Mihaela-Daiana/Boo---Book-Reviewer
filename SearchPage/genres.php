<?php
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


$sql = "SELECT 
            genre_id, 
            genre_name
            FROM 
            genre";

$result = $conn->query($sql);

if ($result === false) {
    die(json_encode(array('success' => false, 'error' => 'Query error: ' . $conn->error)));
}

if ($result) {
    $genre = array();

    while ($row = $result->fetch_assoc()) {
        $genre[] = $row;
    }


    header('Content-Type: application/json');
    echo json_encode(array('success' => true, 'genre' => $genre));
} else {

    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'Database query error: ' . $conn->error));
}


$conn->close();
?>