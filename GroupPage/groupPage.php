<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['group_id'])) {
    echo "Group ID is missing.";
    exit;
}

$group_id = $_GET['group_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users in the group
$sql = "SELECT u.user_id, u.username FROM user_group ug JOIN user u ON ug.user_id = u.user_id WHERE ug.group_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $group_id);
$stmt->execute();
$result = $stmt->get_result();
$group_users = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../GroupPage/style.css">
    <link rel="icon" type="image/png" href="../BookReviewer/pictures/Boo-Logov_favicon.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap">
    <title>Group Page</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="groupPage.js"></script>

    <header class="header_BOO">
        <div class="logo header__logo">
            <img src="../BookReviewer/pictures/Boo-Logo.png" alt="Logo" class="logo__image"
                onclick="window.location.href='../MainPage/landingpage.php?user_id=<?php echo $user_id; ?>';" />
        </div>

        <div class="search">
            <form action="../SearchPage/searchPage.php" method="POST" id="searchForm">
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
                    <a href="../AboutPage/aboutpage.html" class="nav__link_menu">About</a>
                </li>
                <li class="nav__item">
                    <a href="../BookReviewer/index.html" class="nav__link_menu">LogOut</a>
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
                        <a href="../AboutPage/aboutpage.html" class="nav__link_menu">About</a>
                    </li>
                    <li class="nav__item">
                        <a href="../BookReviewer/index.html" class="nav__link_menu">LogOut</a>
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
                        <p class="profile__p">Group Members:</p>
                        <br />
                        <ul class="group__list" id="group-users">
                            <?php foreach ($group_users as $user): ?>
                                <li class="group__item">
                                    <a href="../AccountPage/account.php?user_id=<?php echo $user['user_id']; ?>"
                                        class="group__link"><?php echo $user['username']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="feed_container_main_feed">
                <div class="main_feed__title">Group Activity</div>
                <div class="friend__container" id="group-activity">
                    <!-- Group activity will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </div>
    <script src="../SearchPage/add_to_search.js"></script>
</body>

</html>