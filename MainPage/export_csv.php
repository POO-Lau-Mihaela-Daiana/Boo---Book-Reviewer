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

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="top_5_books.csv"');
    
    $output = fopen('php://output', 'w');
    
    fputcsv($output, ['Book Title', 'Average Rating']);
    
    while($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
    
    fclose($output);
} else {
    header('Content-Type: application/json');
    echo json_encode(array('success' => false, 'error' => 'No results found.'));
}

$conn->close();
?>
