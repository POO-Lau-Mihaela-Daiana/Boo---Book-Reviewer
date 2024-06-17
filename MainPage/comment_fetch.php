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
            user.username, 
            user.user_id,
            comment.comment_text, 
            comment.comment_posted_date, 
            comment.comment_posted_hour,
            book.book_title,
            book.book_id
        FROM 
            comment
        JOIN 
            user ON comment.user_id = user.user_id
        JOIN 
            book_comment ON comment.comment_id = book_comment.comment_id
        JOIN 
            book ON book_comment.book_id = book.book_id
        ORDER BY 
            comment.comment_id DESC 
        LIMIT 10";

$result = $conn->query($sql);


if ($result) {
    $comment = array();


    while ($row = $result->fetch_assoc()) {
        $comment[] = $row;
    }


    header('Content-Type: application/json');
    echo json_encode(array('success' => true, 'comment' => $comment));
} else {

    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'Database query error: ' . $conn->error));
}


$conn->close();
?>