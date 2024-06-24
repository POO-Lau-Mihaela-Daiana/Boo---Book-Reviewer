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
    $bookId = $_POST['book_id'];
    $bookPhoto = $_POST['bookPhoto'];
    $bookName = $_POST['bookName'];
    $bookAuthor = $_POST['bookAuthor'];
    $bookDescription = $_POST['bookDescription'];
    $bookPages = intval($_POST['bookPages']);
    $bookPublisher = $_POST['bookPublisher'];
    $bookPublicationDate = $_POST['bookPublicationDate'];
    $bookGenres = isset($_POST['bookGenres']) ? $_POST['bookGenres'] : '';

    if (empty($bookId)) {
        echo json_encode(['success' => false, 'error' => 'Book ID not provided']);
        exit;
    }

    $conn->begin_transaction();

    try {
        
        $sql = "UPDATE book SET ";
        $params = [];
        $types = "";

        if (!empty($bookPhoto)) {
            $sql .= "book_photo_url = ?, ";
            $params[] = $bookPhoto;
            $types .= "s";
        }
        if (!empty($bookName)) {
            $sql .= "book_title = ?, ";
            $params[] = $bookName;
            $types .= "s";
        }
        if (!empty($bookAuthor)) {
            $sql .= "book_author = ?, ";
            $params[] = $bookAuthor;
            $types .= "s";
        }
        if (!empty($bookDescription)) {
            $sql .= "book_description = ?, ";
            $params[] = $bookDescription;
            $types .= "s";
        }
        if (!empty($bookPages)) {
            $sql .= "book_pages = ?, ";
            $params[] = $bookPages;
            $types .= "i";
        }
        if (!empty($bookPublisher)) {
            $sql .= "book_publisher = ?, ";
            $params[] = $bookPublisher;
            $types .= "s";
        }
        if (!empty($bookPublicationDate)) {
            $sql .= "book_publication = ?, ";
            $params[] = $bookPublicationDate;
            $types .= "s";
        }

       
        $sql = rtrim($sql, ", ") . " WHERE book_id = ?";
        $params[] = $bookId;
        $types .= "i";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }

        $stmt->bind_param($types, ...$params);

        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        $stmt->close();

       
        if (!empty($bookGenres)) {
           
            $stmt = $conn->prepare("DELETE FROM book_genre WHERE book_id = ?");
            $stmt->bind_param("i", $bookId);
            if (!$stmt->execute()) {
                throw new Exception('Execute failed: ' . $stmt->error);
            }
            $stmt->close();

           
            $bookGenresArray = explode(',', $bookGenres);
            foreach ($bookGenresArray as $genre) {
                $genre = trim($genre);
                if (!empty($genre)) {
                    $stmt = $conn->prepare("SELECT genre_id FROM genre WHERE genre_name = ?");
                    $stmt->bind_param("s", $genre);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows == 0) {
                        $stmt->close();

                        $stmt = $conn->prepare("INSERT INTO genre (genre_name) VALUES (?)");
                        $stmt->bind_param("s", $genre);
                        if ($stmt->execute()) {
                            $genre_id = $stmt->insert_id;
                        } else {
                            throw new Exception('Execute failed: ' . $stmt->error);
                        }
                    } else {
                        $stmt->bind_result($genre_id);
                        $stmt->fetch();
                    }
                    $stmt->close();

                    $stmt = $conn->prepare("INSERT INTO book_genre (book_id, genre_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $bookId, $genre_id);
                    if (!$stmt->execute()) {
                        throw new Exception('Execute failed: ' . $stmt->error);
                    }
                    $stmt->close();
                }
            }
        }

        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Book updated successfully']);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    $conn->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}
?>
