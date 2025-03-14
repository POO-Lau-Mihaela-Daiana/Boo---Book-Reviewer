<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../LogIn/login.html"); 
  exit;
}

$user_id = $_SESSION['user_id'];
$book_id = $_GET['book_id']; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="../BookReviewer/pictures/Boo-Logov_favicon.png" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" />
  <link rel="stylesheet" href="../book/style.css" />
  <title>BOO</title>
</head>

<body>

  <header class="header_BOO">
    <div class="logo header__logo">
      <img src="../BookReviewer/pictures/Boo-Logo.png" alt="Logo" class="logo__image"
        onclick="window.location.href='../MainPage/landingpage.php?user_id=<?php echo $user_id; ?>';" />
    </div>

    <div class="search">
    <form action="../SearchPage/searchPage.php?user_id=<?php echo $user_id; ?>" method="GET" id="searchForm">
        <input type="text" class="search__input" id="search" placeholder="Book Name" />
        <button type="submit" class="search__button">
          Search Book Here
        </button>
      </form>
    </div>

    <nav class="nav">
      <ul class="nav__list">
        <li class="nav__item">
          <a href="../Library/index.php?user_id=<?php echo $user_id; ?>" class="nav__link">Librarys</a>
        </li>
        <li class="nav__item">
          <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Groups</a>
        </li>
        <li class="nav__item">
          <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Account</a>
        </li>
        <li class="nav__item">
          <a href="../Settings/settings.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Settings</a>
        </li>
        <li class="nav__item">
          <a href="../AboutPage/aboutpage.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">About</a>
        </li>
         <li class="nav__item">
    <a href="../BookReviewer/logout.php" class="nav__link_menu">LogOut</a>
      </li>
      </ul>
      <div class="nav__item_special">
        <p>Menu</p>
        <ul class="nav_dropdown">
          <li class="nav__item">
            <a href="../Library/index.php?user_id=<?php echo $user_id; ?>" class="nav__link">Library</a>
          </li>
          <li class="nav__item">
            <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Groups</a>
          </li>
          <li class="nav__item">
            <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Account</a>
          </li>
          <li class="nav__item">
            <a href="../Settings/settings.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Settings</a>
          </li>
          <li class="nav__item">
            <a href="../AboutPage/aboutpage.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">About</a>
          </li>
          <li class="nav__item">
    <a href="../BookReviewer/logout.php" class="nav__link_menu">LogOut</a>
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
            <img src="../BookReviewer/pictures/book_cover.jpeg" alt="Book Cover" />
            <p></p>
            <br />
            <button class="want-to-read-btn" data-status="want_to_read">Want to Read</button><br>
            <button class="want-to-read-btn" data-status="currently_reading">Currently Reading</button><br>
            <button class="want-to-read-btn" data-status="read">Read</button>
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

    <div class="side_part">
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
                <div class="bar" id="five-star-bar" style="width: 0;"></div>
              </div>
              <p id="five-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>4<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="four-star-bar" style="width: 0;"></div>
              </div>
              <p id="four-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>3<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="three-star-bar" style="width: 0;"></div>
              </div>
              <p id="three-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>2<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="two-star-bar" style="width: 0;"></div>
              </div>
              <p id="two-star-count">456</p>
            </div>

            <div class="rating__progress-value">
              <p>1<span class="star">&#9733;</span></p>
              <div class="progress">
                <div class="bar" id="one-star-bar" style="width: 0;"></div>
              </div>
              <p id="one-star-count">456</p>
            </div>
          </div>
        </div>
      </div>

      <div class="side_rating">
        <div class="review-form">
          <form method="POST" action="add_review.php" id="reviewForm">
            <textarea id="ratingText" name="rating" placeholder="Write your rating!" required></textarea>
            <button type="submit" class="submit-comment-btn">Submit</button>
          </form>
        </div>
      </div>

      <div class="side-bar">
        <h2>Leave a Comment</h2>
        <div class="comment-form">
          <form method="POST" action="add_comment.php" id="commentForm">
            <textarea id="commentText" rows="4" placeholder="Write your comment here..." required></textarea>
            <button type="submit" class="submit-comment-btn">Submit</button>
          </form>
        </div>
      </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../MainPage/scrip.js"></script>
  <script src="../book/book_javax.js"></script>
  <script src="../SearchPage/add_to_search.js"></script>
</body>

</html>