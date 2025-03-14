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
  <link rel="icon" type="image/png" href="../BookReviewer/pictures/Boo-Logov_favicon.png" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" />
  <title>BOO</title>
  <link rel="stylesheet" href="../AccountPage/style.css" />
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../AccountPage/fetch_info.js"></script>
  <script src="../MainPage/scrip.js"></script>
  <script src="../SearchPage/add_to_search.js"></script>
  <script src="account.js"></script>
  <script src="fetch_friends.js"></script>

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

  <div class="block_container">
    <div class="profile__container">
      <div class="container__side">
        <img id="user_url" alt="account photo" class="side__photo" />

        <div class="side__name">Name : <p id="username"> EXAMPLE OF NAME</p>
        </div>
        <div class="side__date">Member since: <p id="user_date_of_creation">EXAMPLE OF DATE</p>
        </div>
        <br />
        <br />
        <div class="side__books">Want to change the details</div>
        <div class="side__books">for your account?</div>
        <div class="main__settings">
          <button class="main__settings__button"
            onclick="window.location.href='../Settings/settings.php?user_id=<?php echo $user_id; ?>';">
            Settings
          </button>
        </div>
      </div>

      <div class="container__main">
        <div class="main__books">
          <div class="main__books__title">
            <p>Currently reading</p>
            <div class="books__container">

            </div>
          </div>
        </div>
        <div class="main__groups">
          <p class="group_list_name">Groups!</p>
          <ul class="group__list" id="group__list">
          </ul>
        </div>
        <div class="main__friends">
          <p class="friends_list_name">Friends</p>
          <div class="friends__container" id="friends__container"></div>
        </div>


        <div class="about__me__section">
          <div class="section">
            <p class="section__type">Interests</p>
            <p class="info" id="user_description">
              Nothing to see here!
            </p>
          </div>
          <div class="section">
            <p class="section__type">About me:</p>
            <p class="info" id="user_tips">
              Nothing to see here!
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>