<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'message' => 'Connection failed: ' . $conn->connect_error)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookPhoto = $_POST['bookPhoto'];
    $bookName = $_POST['bookName'];
    $bookAuthor = $_POST['bookAuthor'];
    $bookDescription = $_POST['bookDescription'];
    $bookPages = intval($_POST['bookPages']);
    $bookPublisher = $_POST['bookPublisher'];
    $bookPublicationDate = $_POST['bookPublicationDate'];
    $bookGenres = isset($_POST['bookGenres']) ? $_POST['bookGenres'] : '';

    if (!isset($_POST['bookGenres']) || $_POST['bookGenres'] === '') {
        echo json_encode(['success' => false, 'error' => 'Book genres not provided']);
        exit;
    }

    $conn->begin_transaction();

    try {
       
        $stmt = $conn->prepare("INSERT INTO book (book_photo_url, book_title, book_author, book_description, book_pages, book_publisher, book_publication) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            throw new Exception('Prepare statement failed: ' . $conn->error);
        }

        $stmt->bind_param("ssssiss", $bookPhoto, $bookName, $bookAuthor, $bookDescription, $bookPages, $bookPublisher, $bookPublicationDate);

        if (!$stmt->execute()) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }
        $bookId = $stmt->insert_id;
        $stmt->close();

        // Split genres by comma and insert them into book_genre table
        if (!empty($bookGenres)) {
            $bookGenresArray = explode(',', $bookGenres);
            foreach ($bookGenresArray as $genre) {
                $genre = trim($genre); // Remove any surrounding whitespace
                if (!empty($genre)) {
                    // Check if genre already exists
                    $stmt = $conn->prepare("SELECT genre_id FROM genre WHERE genre_name = ?");
                    $stmt->bind_param("s", $genre);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows == 0) {
                        $stmt->close();
                        // Insert new genre
                        $stmt = $conn->prepare("INSERT INTO genre (genre_name) VALUES (?)");
                        $stmt->bind_param("s", $genre);
                        if ($stmt->execute()) {
                            $genre_id = $stmt->insert_id;
                        } else {
                            throw new Exception('Execute failed: ' . $stmt->error);
                        }
                    } else {
                        // Fetch the existing genre_id
                        $stmt->bind_result($genre_id);
                        $stmt->fetch();
                    }
                    $stmt->close();

                    // Insert into book_genre table
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
        echo json_encode(['success' => true, 'message' => 'Book added successfully']);

    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    $conn->close();
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}
?>
