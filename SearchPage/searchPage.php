<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
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
      href="https://fonts.googleapis.com/css2?family=Rubik&display=swap"
    />
    <link rel="stylesheet" href="../SearchPage/style.css" />
    <title>Boo</title>
  </head>
  <body>
    <header class="header_BOO">
      <div class="logo header__logo">
      <img
          src="../BookReviewer/pictures/Boo-Logo.png"
          alt="Logo"
          class="logo__image"
          onclick="window.location.href='../MainPage/landingpage.php?user_id=<?php echo $user_id; ?>';"
        />
      </div>

      <div class="search">
        <form action="../SearchPage/searchPage.php" method="POST" id="searchForm">
            <input type="text" class="search__input" name="search" placeholder="Book Name" />
            <button type="submit" class="search__button">
                Search Book Here
            </button>
        </form>
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
          <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu"
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
            <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Account</a>
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
    <div class="Whole__Page">
      <div class="Big__Container">
        <div class="side__container">
          <p class="side__container__text">Want a certain genre?</p>
          <div class="genre__total__list">
            <label class="genre_list"><input type="checkbox" />Romance</label>
            <label class="genre_list"><input type="checkbox" />Thriller</label>
            <label class="genre_list"><input type="checkbox" />Horror</label>
            <label class="genre_list"><input type="checkbox" />Fantasy</label>
            <label class="genre_list"
              ><input type="checkbox" />Science Fiction</label
            >
            <label class="genre_list"><input type="checkbox" />Mystery</label>
            <label class="genre_list"
              ><input type="checkbox" />Historical Fiction</label
            >
            <label class="genre_list"><input type="checkbox" />Adventure</label>
            <label class="genre_list"><input type="checkbox" />Dystopian</label>
            <label class="genre_list"><input type="checkbox" />Comedy</label>
            <label class="genre_list"
              ><input type="checkbox" />Young Adult</label
            >
            <label class="genre_list"
              ><input type="checkbox" />Non-fiction</label
            >
            <label class="genre_list"><input type="checkbox" />Crime</label>
            <label class="genre_list"
              ><input type="checkbox" />Paranormal</label
            >
            <label class="genre_list"
              ><input type="checkbox" />Literary Fiction</label
            >
            <label class="genre_list"
              ><input type="checkbox" />Supernatural</label
            >
            <label class="genre_list"><input type="checkbox" />Action</label>
            <label class="genre_list"
              ><input type="checkbox" />Contemporary</label
            >
            <label class="genre_list"><input type="checkbox" />Poetry</label>
            <label class="genre_list"><input type="checkbox" />Satire</label>
            <label class="genre_list"><input type="checkbox" />Humor</label>
            <label class="genre_list"><input type="checkbox" />Drama</label>
            <label class="genre_list"><input type="checkbox" />Romance</label>
            <label class="genre_list"
              ><input type="checkbox" />Psychological thriller</label
            >
          </div>
        </div>
        <div class="main_container">
          <div class="main_feed__title">Books found:</div>
          <div class="book__container">
            <div class="book__container__profile">
          
        </div>
      </div>
    </div>
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="fetch_searching.js"></script>
  </body>
</html>
