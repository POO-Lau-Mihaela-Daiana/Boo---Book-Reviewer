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

$sql = "
    SELECT book.book_title, AVG(book_rating.rating) AS average_rating
    FROM book 
    JOIN book_rating ON book_rating.book_id = book.book_id 
    GROUP BY book.book_title 
    ORDER BY average_rating DESC 
    LIMIT 5
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $filename = 'top_5_books.xml';
    $xml = new SimpleXMLElement('<booklist/>');
    while($row = $result->fetch_assoc()) {
        $book = $xml->addChild('book');
        $book->addChild('title', $row['book_title']);
        $book->addChild('average_rating', $row['average_rating']);
    }
    $xml->asXML($filename);

    echo $filename;
} else {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'No results found.'));
}

$conn->close();
?>
