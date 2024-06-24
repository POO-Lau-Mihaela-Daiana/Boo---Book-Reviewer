<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/login.html");
    exit;
}

$user_id = $_SESSION['user_id'];

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

if(isset($_POST['search'])) {
    $search = '%' . $conn->real_escape_string($_POST['search']) . '%';
    
    
    $sql_search = "SELECT DISTINCT book.book_id, book.book_title, book.book_author, book.book_description, book.book_photo_url 
                   FROM book 
                   JOIN
                   book_genre 
                   ON
                   book_genre.book_id=book.book_id
                   join 
                   genre
                   ON
                   genre.genre_id=book_genre.genre_id 
                   WHERE book.book_title LIKE ?";
    
    $params = array($search);

   
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $genre = $_POST['genre'];
        $sql_search .= " AND genre.genre_id = ?";
        $params[] = $genre;
    }

    $stmt = $conn->prepare($sql_search);

   
    $types = str_repeat('s', count($params)); 
    $stmt->bind_param($types, ...$params);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $searchResults = array();

        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode(array('success' => true, 'search' => $searchResults));
    } else {
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'message' => 'No books found.'));
    }

    $stmt->close();
} else {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'message' => 'No search query provided.'));
}

$conn->close();
?>
