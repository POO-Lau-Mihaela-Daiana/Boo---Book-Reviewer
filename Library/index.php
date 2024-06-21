<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Library/style.css" />
    <link rel="icon" type="image/png" href="../BookReviewer/pictures/Boo-Logov_favicon.png" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" />
    <title>BOO</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="library_javax.js"></script>

    <header class="header_BOO">
        <div class="logo header__logo">
            <img src="../BookReviewer/pictures/Boo-Logo.png" alt="Logo" class="logo__image"
                onclick="window.location.href='../MainPage/landingpage.html';" />
        </div>

        <div class="search">
            <input type="text" class="search__input" placeholder="Book Name" />
            <button class="search__button" onclick="window.location.href='../SearchPage/searchPage.html';">
                Search Book
            </button>
        </div>

        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="../Library/index.html" class="nav__link">Library</a>
                </li>
                <li class="nav__item">
                    <a href="../LookForGroupPage/lookFor.html" class="nav__link">Groups</a>
                </li>
                <li class="nav__item">
                    <a href="../AccountPage/account.html" class="nav__link">Account</a>
                </li>
                <li class="nav__item">
                    <a href="../Settings/settings.html" class="nav__link_menu">Settings</a>
                </li>
                <li class="nav__item">
                    <a href="../AboutPage/aboutpage.html" class="nav__link_menu">About</a>
                </li>
            </ul>
            <div class="nav__item_special">
                <p>Menu</p>
                <ul class="nav_dropdown">
                    <li class="nav__item">
                        <a href="../Library/index.html" class="nav__link">Library</a>
                    </li>
                    <li class="nav__item">
                        <a href="../LookForGroupPage/lookFor.html" class="nav__link_menu">Groups</a>
                    </li>
                    <li class="nav__item">
                        <a href="../AccountPage/account.html" class="nav__link_menu">Account</a>
                    </li>
                    <li class="nav__item">
                        <a href="../Settings/settings.html" class="nav__link_menu">Settings</a>
                    </li>
                    <li class="nav__item">
                        <a href="../AboutPage/aboutpage.html" class="nav__link_menu">About</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="block_container">
        <div class="feed_container">
            <div class="feed_container_side">
                <div class="library-container">
                    <div class="categories">
                        <h2>Categories</h2>
                        <ul>
                            <li><button class="category-button" onclick="loadBooks('all')">All</button></li>
                            <li><button class="category-button" onclick="loadBooks('want_to_read')">Want to
                                    Read</button></li>
                            <li><button class="category-button" onclick="loadBooks('read')">Read</button></li>
                            <li><button class="category-button" onclick="loadBooks('currently_reading')">Currently
                                    Reading</button></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="feed_container_main_feed">
                <div class="main_feed__title">Books</div>
                <div class="book__container" id="books_container">

                </div>
            </div>
        </div>
    </div>
</body>

</html>