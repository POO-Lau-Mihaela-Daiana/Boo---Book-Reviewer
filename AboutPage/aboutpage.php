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
    <link rel="stylesheet" href="../AboutPage/style.css" />
    <link
      rel="icon"
      type="image/png"
      href="../BookReviewer/pictures/Boo-Logov_favicon.png"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
    />
    <title>BOO</title>
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>

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
            <a href="../Library/index.php?user_id=<?php echo $user_id; ?>" class="nav__link">Library</a>
          </li>
          <li class="nav__item">
            <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>" class="nav__link"
              >Groups</a
            >
          </li>
          <li class="nav__item">
            <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>" class="nav__link">Account</a>
          </li>
          <li class="nav__item">
            <a href="../Settings/settings.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu"
              >Settings</a
            >
          </li>
          <li class="nav__item">
            <a href="../AboutPage/aboutpage.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu"
              >About</a
            >
          </li>
        </ul>
        <div class="nav__item_special">
          <p>Menu</p>
          <ul class="nav_dropdown">
            <li class="nav__item">
              <a href="../Library/index.php?user_id=<?php echo $user_id; ?>" class="nav__link">Library</a>
            </li>
            <li class="nav__item">
              <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu"
                >Groups</a
              >
            </li>
            <li class="nav__item">
              <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu"
                >Account</a
              >
            </li>
            <li class="nav__item">
              <a href="../Settings/settings.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu"
                >Settings</a
              >
            </li>
            <li class="nav__item">
              <a href="../AboutPage/aboutpage.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu"
                >About</a
              >
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="AboutUs__Heading">
      <h1>About Us</h1>
      <p>Uncover Your Next Page-Turning Adventure!</p>
    </div>
    <div class="body_container">
      <section class="body__container__about">
        <div class="about__image">
          <img
            class="about_image_link"
            src="../BookReviewer/pictures/Logo-AboutPage.png"
            alt="Boo Logo"
          />
        </div>
        <div class="about__content">
          <h2 class="about__content__h2">Your unique library</h2>
          <p class="about__content__p">
            Discover, share, and indulge in the world of literature with our
            app. Whether you're an avid reader or just beginning your literary
            journey, our platform offers a personalized experience tailored to
            your tastes. Explore a vast collection of books, connect with fellow
            bookworms, and stay updated on the latest releases and literary
            trends. Dive into captivating reviews, curated recommendations, and
            engaging discussions. Join our community of bibliophiles and embark
            on an adventure through the endless realms of storytelling.
          </p>
          <a href="../HelpPage/index.html" class="content__readMore"
            >Read more!</a
          >
        </div>
      </section>
    </div>
  </body>
</html>
