<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../LogIn/login.html"); 
  exit;
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../LookForGroupPage/style.css" />
    <link rel="icon" type="image/png" href="../BookReviewer/pictures/Boo-Logov_favicon.png" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" />
    <title>BOO</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="lookFor.js"></script>

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
                    <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>"
                        class="nav__link_menu">Groups</a>
                </li>
                <li class="nav__item">
                    <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>"
                        class="nav__link_menu">Account</a>
                </li>
                <li class="nav__item">
                    <a href="../Settings/settings.php?user_id=<?php echo $user_id; ?>"
                        class="nav__link_menu">Settings</a>
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
                        <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>"
                            class="nav__link_menu">Groups</a>
                    </li>
                    <li class="nav__item">
                        <a href="../AccountPage/account.php?user_id=<?php echo $user_id; ?>"
                            class="nav__link_menu">Account</a>
                    </li>
                    <li class="nav__item">
                        <a href="../Settings/settings.php?user_id=<?php echo $user_id; ?>"
                            class="nav__link_menu">Settings</a>
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
        <div class="feed_container">
            <div class="feed_container_side">
                <div class="feed_container_side_">
                    <div class="profile">
                        <img src="../BookReviewer/pictures/pfp.jpg" alt="Profile Picture" class="profile__image" />
                        <p class="profile__p">Current Groups:</p>
                        <br />
                        <ul class="group__list" id="current-groups">
                            
                        </ul>
                        <h3>Want to own a group?</h3>
                        <div class="New__Group">
                            <button class="create__new"
                                onclick="window.location.href='../CreateGroup/creategroup.php?user_id=<?php echo $user_id; ?>';">Create
                                Group</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feed_container_main_feed">
                <div class="main_feed__title">Open Groups</div>
                <div class="friend__container" id="open-groups">
                 
                </div>
            </div>
        </div>
    </div>
    <script src="../SearchPage/add_to_search.js"></script>
</body>

</html>