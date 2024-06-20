<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$book_id = $_GET['book_id']; //HOW ELSE CAN I DO THIS WTF
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="icon"
      type="image/png"
      href="../BookReviewer/pictures/Boo-Logov_favicon.png"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
    />
    <link rel="stylesheet" href="../book/style.css" />
    <title>BOO</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="../book/book_javax.js"></script>
    <header class="header_BOO">
      <div class="logo header__logo">
        <img
          src="../BookReviewer/pictures/Boo-Logo.png"
          alt="Logo"
          class="logo__image"
          onclick="window.location.href='../MainPage/landingpage.html';"
        />
      </div>

      <div class="search">
        <input type="text" class="search__input" placeholder="Book Name" />
        <button
          class="search__button"
          onclick="window.location.href='../SearchPage/searchPage.html';"
        >
          Search Book
        </button>
      </div>

      <nav class="nav">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="../Library/index.html" class="nav__link">Library</a>
          </li>
          <li class="nav__item">
            <a href="../LookForGroupPage/lookFor.html" class="nav__link"
              >Groups</a
            >
          </li>
          <li class="nav__item">
            <a href="../AccountPage/account.html" class="nav__link">Account</a>
          </li>
          <li class="nav__item">
            <a href="../Settings/settings.html" class="nav__link_menu"
              >Settings</a
            >
          </li>
          <li class="nav__item">
            <a href="../AboutPage/aboutpage.html" class="nav__link_menu"
              >About</a
            >
          </li>
        </ul>
        <div class="nav__item_special">
          <p>Menu</p>
          <ul class="nav_dropdown">
            <li class="nav__item">
              <a href="../Library/index.html" class="nav__link">Library</a>
            </li>
            <li class="nav__item">
              <a href="../LookForGroupPage/lookFor.html" class="nav__link_menu"
                >Groups</a
              >
            </li>
            <li class="nav__item">
              <a href="../AccountPage/account.html" class="nav__link_menu"
                >Account</a
              >
            </li>
            <li class="nav__item">
              <a href="../Settings/settings.html" class="nav__link_menu"
                >Settings</a
              >
            </li>
            <li class="nav__item">
              <a href="../AboutPage/aboutpage.html" class="nav__link_menu"
                >About</a
              >
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="body_containers">
      <div class="body_container">
        <div class="main-content">
          <div class="book-details">
            <div class="book-cover">
              <img
                src="../BookReviewer/pictures/book_cover.jpeg"
                alt="Book Cover"
              />
              <p></p>
              <br />
              <button class="want-to-read-btn">Want to Read</button>
              <div class="rating-stars">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
              </div>
            </div>
            <div class="book-info">
              <h1 id="book-title">Book Title</h1>
              <h2>Description</h2>
              <p id="book-description">
                Book description will be displayed here.
              </p>
              <h2>Details</h2>
              <ul id="book-details">
                <li><strong>Pages:</strong> <span id="book-pages"></span></li>
                <li>
                  <strong>Publisher:</strong> <span id="book-publisher"></span>
                </li>
                <li>
                  <strong>Publication Date:</strong>
                  <span id="book-publication-date"></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <h2>Reviews</h2>
        <div class="reviews" id="reviews"></div>
      </div>

      <div class="side_reviews">
        <div class="rating">
          <div class="rating__average">
            <h1 id="average-rating">4.5</h1>
            <div class="star_outer">
              <div class="star_inner">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            </div>
            <p id="total-reviews">234</p>
          </div>

          <div class="rating__progress">
            <div class="rating__progress-value">
              <p>5<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="five-star-bar"></div>
              </div>
              <p id="five-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>4<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="four-star-bar"></div>
              </div>
              <p id="four-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>3<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="three-star-bar"></div>
              </div>
              <p id="three-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>2<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="two-star-bar"></div>
              </div>
              <p id="two-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>1<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="one-star-bar"></div>
              </div>
              <p id="one-star-count">456</p>
            </div>
          </div>
        </div>
      </div>

      <div class="side-bar">
        <h2>Leave a Comment</h2>
        <div class="comment-form">
          <form method="POST" action="add_comment.php" id="commentForm">
            <textarea
              id="commentText"
              rows="4"
              placeholder="Write your comment here..."
              required
            ></textarea>
            <button type="submit" class="submit-comment-btn">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
