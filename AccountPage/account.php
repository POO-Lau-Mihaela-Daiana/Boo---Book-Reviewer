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
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
    />
    <title>BOO</title>
    <link rel="stylesheet" href="../AccountPage/style.css" />
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../AccountPage/fetch_info.js"></script>
    <script src="../MainPage/scrip.js"></script>

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
            <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>" class="nav__link">Account</a>
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
        </div>
      </nav>
    </header>

    <div class="block_container">
      <div class="profile__container">
        <div class="container__side">
          <img
            src="../BookReviewer/pictures/pfp.jpg"
            alt="account photo"
            class="side__photo"
          />

          <div class="side__name">Name : <p id="username"> EXAMPLE OF NAME</p></div>
          <div class="side__date">Member since: <p id="user_date_of_creation">EXAMPLE OF DATE</p></div>
          <div class="side__books">Nr of books : 24</div>
          <br />
          <br />
          <div class="side__books">Want to change the details</div>
          <div class="side__books">for your account?</div>
          <div class="main__settings">
            <button
              class="main__settings__button"
              onclick="window.location.href='../Settings/settings.html';"
            >
              Settings
            </button>
          </div>
        </div>

        <div class="container__main">
          <div class="main__books">
            <div class="main__books__title">
              <p>Currently reading</p>
              <div class="books__container">
                <div class="book">
                  <p class="book__title">FIRST BOOK</p>
                  <img
                    src="../BookReviewer/pictures/pfp.jpg"
                    alt="Book-Cover"
                    class="book__photo"
                  />
                </div>
                <div class="book">
                  <p class="book__title">FIRST BOOK</p>
                  <img
                    src="../BookReviewer/pictures/pfp.jpg"
                    alt="Book-Cover"
                    class="book__photo"
                  />
                </div>
              
            
              </div>
            </div>
          </div>
          <div class="main__friends">
            <p class="friend_list_name">Friends</p>
            <ul class="friend__list">
              <li class="friend__item">
                <a
                  href="../AccountPage/others_account.html"
                  class="friend__link"
                  >Account1</a
                >
              </li>
            
            </ul>
          </div>
          <div class="about__me__section">
            <div class="section">
              <p class="section__type">Interests</p>
              <p id="user_description">
               Nothing to see here!
              </p>
            </div>
            <div class="section">
              <p class="section__type">About me:</p>
              <p id="user_tips">
                Nothing to see here!
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
