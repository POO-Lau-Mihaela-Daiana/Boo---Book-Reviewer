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

if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']); 

  
    $sql_book ="SELECT 
                    book.book_title, 
                    book.book_author, 
                    book.book_description, 
                    book.book_pages, 
                    book.book_publisher, 
                    book.book_publication, 
                    book.book_photo_url,
                    GROUP_CONCAT(genre.genre_name SEPARATOR ', ') AS genres
                 FROM book 
                 JOIN book_genre ON book.book_id = book_genre.book_id
                 JOIN genre ON book_genre.genre_id = genre.genre_id 
                 WHERE book.book_id = ?
                 GROUP BY book.book_id";

    $stmt_book = $conn->prepare($sql_book);
    if ($stmt_book === false) {
        die(json_encode(array('success' => false, 'error' => 'Prepare statement failed: ' . $conn->error)));
    }

    $stmt_book->bind_param("i", $book_id);
    $stmt_book->execute();
    $result_book = $stmt_book->get_result();

    if ($result_book === false || $result_book->num_rows === 0) {
        $stmt_book->close();
        $conn->close();
        die(json_encode(array('success' => false, 'error' => 'Invalid book ID or query error: ' . $conn->error)));
    }

    $book = $result_book->fetch_assoc();
    $stmt_book->close();


    $sql_comments = "SELECT 
                        user.username, 
                        comment.comment_text, 
                        comment.comment_posted_date, 
                        comment.comment_posted_hour
                     FROM 
                        comment
                     JOIN 
                        user ON comment.user_id = user.user_id
                     JOIN 
                        book_comment ON comment.comment_id = book_comment.comment_id
                     WHERE 
                        book_comment.book_id = ?
                     ORDER BY 
                        comment.comment_id DESC ";
    $stmt_comments = $conn->prepare($sql_comments);
    if ($stmt_comments === false) {
        die(json_encode(array('success' => false, 'error' => 'Prepare statement failed: ' . $conn->error)));
    }

    $stmt_comments->bind_param("i", $book_id);
    $stmt_comments->execute();
    $result_comments = $stmt_comments->get_result();

    if ($result_comments === false) {
        $stmt_comments->close();
        $conn->close();
        die(json_encode(array('success' => false, 'error' => 'Query error: ' . $conn->error)));
    }

    $comments = array();
    while ($row = $result_comments->fetch_assoc()) {
        $comments[] = array(
            'username' => $row['username'],
            'comment_text' => $row['comment_text'],
            'comment_posted_date' => $row['comment_posted_date'],
            'comment_posted_hour' => $row['comment_posted_hour'],
            'book_id' => $book_id,
            'book_title' => $book['book_title']
        );
    }

    echo json_encode(array('success' => true, 'book' => $book, 'comments' => $comments));
    $stmt_comments->close();
} else {
    echo json_encode(array('success' => false, 'error' => 'No book_id provided'));
}

$conn->close();
?>
