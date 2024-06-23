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
    <link rel="stylesheet" href="../CreateGroup/creategroup.css" />
    <link rel="icon" type="image/png" href="../BookReviewer/pictures/Boo-Logov_favicon.png" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" />
    <title>BOO</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="create_group.js"></script>

    <header class="header_BOO">
        <div class="logo header__logo">
            <img src="../BookReviewer/pictures/Boo-Logo.png" alt="Logo" class="logo__image"
                onclick="window.location.href='../MainPage/landingpage.php?user_id=<?php echo $user_id; ?>';" />
        </div>

        <div class="search">
            <form action="../SearchPage/searchPage.php?user_id=<?php echo $user_id; ?>" method="POST" id="searchForm">
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
                    <a href="../BookReviewer/index.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">LogOut</a>
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
                        <a href="../BookReviewer/index.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">LogOut</a>
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
                        <h2 class="account-details__title">Create group here!</h2>
                        <p class="account-details__description">
                            Manage the details for your group
                        </p>
                        <div class="account-details__box">
                            <div class="detail">
                                <label for="group-name">Name:</label>
                                <input type="text" id="group-name" name="group-name" class="detail__input" />
                            </div>
                        </div>
                        <div class="account-details__box">
                            <div class="detail"></div>
                        </div>

                        <div class="about-you">
                            <h3>About This Group</h3>

                            <div class="my-interests">
                                <h4>Description</h4>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" id="group-description"
                                        placeholder="Write about your interests"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="button-group">
                            <button class="btn btn-primary" id="create-group-btn">Create group</button>
                            <button class="btn btn-secondary"
                                onclick="window.location.href='../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>';">Discard</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../SearchPage/add_to_search.js"></script>
</body>

</html>