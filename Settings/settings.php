<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Redirect to login page if not logged in
    exit;
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Settings/style.css" />
    <link rel="icon" type="image/png" href="../BookReviewer/pictures/Boo-Logov_favicon.png" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" />
    <title>BOO</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="settings.js"></script> <!-- Include the new JavaScript file -->

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
                <div class="feed_container_side_">
                    <div class="account-details">
                        <h2 class="account-details__title">Account Settings</h2>
                        <p class="account-details__description">
                            Manage how your account appears on Boo
                        </p>
                        <div class="account-details__box">
                            <div class="detail">
                                <label for="change-name">Username:</label>
                                <input type="text" id="change-name" name="change-name" class="detail__input" />
                            </div>
                        </div>
                        <div class="other-details__box">
                            <div class="detail">
                                <label for="change-url">Change your profile picture:</label>
                                <input type="text" id="change-url" name="change-url" class="detail__input" />
                            </div>
                        </div>
                        <div class="about-you">
                            <h3>About You</h3>
                            <div class="my-interests">
                                <h4>My Interests</h4>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" id="interests"
                                        placeholder="Write about your interests"></textarea>
                                </div>
                            </div>
                            <div class="about-me-part">
                                <h4>About Me (Tips)</h4>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" id="aboutMe"
                                        placeholder="Write about yourself"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="button-group">
                            <button id="save-btn" class="btn btn-primary">
                                Save
                            </button>
                            <button class="btn btn-secondary"
                                onclick="window.location.href='../AccountPage/account.html';">
                                Discard
                            </button>
                        </div>
                        <div id="message"></div> <!-- This will display the success/error message -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>