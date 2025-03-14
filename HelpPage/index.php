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
    <link rel="stylesheet" href="../HelpPage/style.css" />
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
            <li class="nav__item">
    <a href="../BookReviewer/logout.php" class="nav__link_menu">LogOut</a>
      </li>
          </ul>
        </div>
      </nav>
    </header>

    <div class="AboutUs__Heading">
      <h1>About this site: Help</h1>
      <p>
        A little tutorial about this page, and about the details you're going to
        find here.
      </p>
    </div>
    <div class="body_container">
      <section class="body__container__about">
        <div class="about__content">
          <h2 class="about__content__h2">1.Introduction</h2>
          <p class="about__content__p">
            Welcome to our help page! 📚 We're thrilled to have you here and
            excited to assist you on your journey through our platform. Whether
            you're a seasoned reader or just starting to explore the world of
            literature, our website is designed with you in mind. Here, you'll
            find a treasure trove of resources, tips, and assistance to enhance
            your reading experience and make the most out of our platform. From
            discovering new books to connecting with fellow bookworms, our goal
            is to create a vibrant community where reading enthusiasts like
            yourself can thrive. So, whether you're seeking recommendations for
            your next literary adventure, need help navigating our features, or
            simply want to connect with fellow book lovers, you've come to the
            right place. Let's embark on this literary journey together! Happy
            reading! 📖
          </p>
          <h2 class="about__content__h2">2. Getting Started Guide:</h2>
          <p class="about__content__p">
            Welcome to our platform! 📚 Whether you're an avid reader or just
            starting to explore the world of literature, we're here to help you
            get the most out of your experience.
          </p>

          <ol>
            <li>
              <strong>Create an Account:</strong> Join our community of book
              lovers by creating an account. It's quick, easy, and free!
            </li>
            <li>
              <strong>Join or Create Reading Groups:</strong> Connect with
              like-minded readers by joining existing reading groups or creating
              your own. Share recommendations, discuss favorite books, and
              engage in lively literary discussions.
            </li>
            <li>
              <strong>Explore and Discover:</strong> Use our powerful search
              feature to explore a vast collection of books. From classics to
              contemporary bestsellers, there's something for everyone.
            </li>
            <li>
              <strong>Organize Your Reading:</strong> Keep track of your reading
              journey by categorizing books into "Read," "Reading," and "Want to
              Read" lists. Stay organized and never lose track of your next
              literary adventure.
            </li>
            <li>
              <strong>Discover Community Reviews:</strong> Get insights and
              recommendations from fellow readers by exploring community reviews
              and ratings for books. Find your next favorite read based on real
              reader experiences.
            </li>
          </ol>
          Let's dive into the world of books together! 📖 Happy reading!
        </div>
      </section>
    </div>
  </body>
</html>
