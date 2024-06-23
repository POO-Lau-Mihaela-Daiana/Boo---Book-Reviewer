<?php
header('Content-Type: application/rss+xml; charset=UTF-8');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT book_title, book_author, book_description FROM book";
$result = $conn->query($sql);

// Nu adăuga nimic înainte de această linie
echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>Book RSS Feed</title>';
echo '<link>http://localhost/Boo---Book-Reviewer/MainPage/</link>';
echo '<description>This is an RSS feed for books</description>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<item>';
        echo '<title>' . htmlspecialchars($row["book_title"], ENT_QUOTES, 'UTF-8') . '</title>';
        echo '<author>' . htmlspecialchars($row["book_writer"], ENT_QUOTES, 'UTF-8') . '</author>';
        echo '<description>' . htmlspecialchars($row["book_description"], ENT_QUOTES, 'UTF-8') . '</description>';
        echo '</item>';
    }
}

echo '</channel>';
echo '</rss>';

$conn->close();
?>