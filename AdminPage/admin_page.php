<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../LogIn/login.html"); 
    exit;
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Boo Admin</title>
    <link
      rel="icon"
      type="image/png"
      href="../BookReviewer/pictures/Boo-Logov_favicon.png"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
    />
    <link rel="stylesheet" href="../AdminPage/styles.css" />
  </head>
  <body>
   

    <div class="block_container">
      <div class="main_container">
        <button class="toggle_button" onclick="toggleForm('addBookForm')">
          Add Book
        </button>
        <div class="form_container" id="addBookForm">
          <h2>Add Book</h2>
          <form id="addBookFormElement" method="POST" action="book_add.php">
            <label for="bookPhoto">Photo URL:</label>
            <input type="text" id="bookPhoto" name="bookPhoto" required /><br />
            <label for="bookName">Name:</label>
            <input type="text" id="bookName" name="bookName" required /><br />
            <label for="bookAuthor">Author:</label>
            <input
              type="text"
              id="bookAuthor"
              name="bookAuthor"
              required
            /><br />
            <label for="bookDescription">Description:</label>
            <textarea
              id="bookDescription"
              name="bookDescription"
              required
            ></textarea
            ><br />
            <label for="bookPages">Pages:</label>
            <input
              type="number"
              id="bookPages"
              name="bookPages"
              required
            /><br />
            <label for="bookGenres">Genres (use commas to separate them):</label>
             <input type="text" id="bookGenres" name="bookGenres" required /><br />
            <label for="bookPublisher">Publisher:</label>
            <input
              type="text"
              id="bookPublisher"
              name="bookPublisher"
              required
            /><br />
            <label for="bookPublicationDate">Publication Date:</label>
            <input
              type="date"
              id="bookPublicationDate"
              name="bookPublicationDate"
              required
            /><br />
          
            <button type="submit">Add Book</button>
          </form>
        </div>

        <button class="toggle_button" onclick="toggleForm('deleteGroupForm')">
          Delete Group
        </button>
        <div class="form_container" id="deleteGroupForm">
          <h2>Delete Group</h2>
          <form id="deleteGroupFormElement" method="POST" action="group_delete.php">
            <label for="group_id">Group ID:</label>
            <input type="text" id="group_id" name="group_id" required /><br />
            <button type="submit">Delete Group</button>
          </form>
          
        </div>

        <button class="toggle_button" onclick="toggleForm('deleteUserForm')">
          Delete User
        </button>
        <div class="form_container" id="deleteUserForm">
          <h2>Delete User</h2>
          <form id="deleteUserFormElement" method="POST" action="delete_user.php">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required /><br />
            <button type="submit">Delete User</button>
          </form>
        </div>

        <button class="toggle_button" onclick="toggleForm('deleteBookForm')">
          Delete Book
        </button>
        <div class="form_container" id="deleteBookForm">
    <h2>Delete Book</h2>
    <form id="deleteBookFormElement" method="POST" action="book_delete.php">
        <label for="book_id">Book ID:</label>
        <input type="text" id="book_id" name="book_id" required /><br />
        <button type="submit">Delete Book</button>
    </form>
</div>
      </div>
      <div
        class="sign-out"
      >
      <button
            type="submit"
            class="signup-button"
            onclick="window.location.href='../BookReviewer/logout.php';"
          >Sign out</div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="book_add_ajax.js"></script>
    <script src="book_delete_ajax.js"></script>
    <script src="user_delete_ajax.js"></script>

  <script>
    function toggleForm(formId) {
      const form = document.getElementById(formId);
      if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
      } else {
        form.style.display = "none";
      }
    }
  </script>
</html>
