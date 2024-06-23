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


$sql_books = "SELECT book_title, book_author, book_description, 'book' AS entry_type FROM book ORDER BY book_id DESC LIMIT 10";
$result_books = $conn->query($sql_books);


$sql_comments = "SELECT 
                    user.username, 
                    user.user_id,
                    user.user_url,
                    comment.comment_text, 
                    comment.comment_posted_hour,
                    book.book_title,
                    book.book_id,
                    'comment' AS entry_type
                FROM 
                    comment
                JOIN 
                    user ON comment.user_id = user.user_id
                JOIN 
                    book_comment ON comment.comment_id = book_comment.comment_id
                JOIN 
                    book ON book_comment.book_id = book.book_id
                ORDER BY 
                    comment.comment_posted_hour DESC 
                LIMIT 10";
$result_comments = $conn->query($sql_comments);

echo '<?xml version="1.0" encoding="UTF-8" ?>';
echo '<rss version="2.0">';
echo '<channel>';
echo '<title>Book RSS Feed</title>';
echo '<link>http://localhost/Boo---Book-Reviewer/</link>';
echo '<description>This is an RSS feed for books and latest comments</description>';
header('Content-Type: application/rss+xml; charset=UTF-8');
if ($result_books->num_rows > 0) {
    while($row = $result_books->fetch_assoc()) {
        echo '<item>';
        echo '<title>' . htmlspecialchars($row["book_title"], ENT_QUOTES, 'UTF-8') . '</title>';
        echo '<author>' . htmlspecialchars($row["book_author"], ENT_QUOTES, 'UTF-8') . '</author>';
        echo '<description>' . htmlspecialchars($row["book_description"], ENT_QUOTES, 'UTF-8') . '</description>';
        echo '<category>' . htmlspecialchars($row["entry_type"], ENT_QUOTES, 'UTF-8') . '</category>';
        echo '</item>';
    }
}

header('Content-Type: application/rss+xml; charset=UTF-8');
if ($result_comments->num_rows > 0) {
    while($row = $result_comments->fetch_assoc()) {
        echo '<item>';
        echo '<title>' . htmlspecialchars($row["username"] . ' commented on ' . $row["book_title"], ENT_QUOTES, 'UTF-8') . '</title>';
        echo '<author>' . htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8') . '</author>';
        echo '<description>' . htmlspecialchars($row["comment_text"], ENT_QUOTES, 'UTF-8') . '</description>';
        echo '<category>' . htmlspecialchars($row["entry_type"], ENT_QUOTES, 'UTF-8') . '</category>';
        echo '</item>';
    }
}

echo '</channel>';
echo '</rss>';

$conn->close();
?>
