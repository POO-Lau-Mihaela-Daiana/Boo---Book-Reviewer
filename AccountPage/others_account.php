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
    <title>BOO</title>
    <link
      rel="icon"
      type="image/png"
      href="../BookReviewer/pictures/Boo-Logov_favicon.png"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
    />
    <link rel="stylesheet" href="../AccountPage/style.css" />
  </head>
  <body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../MainPage/scrip.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../AccountPage/fetch_info_for_others.js"></script>
    <script src="../SearchPage/add_to_search.js"></script>
    
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
            <input type="text" class="search__input" id="search" placeholder="Book Name" />
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
          <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Groups</a>
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
            <a href="../LookForGroupPage/lookFor.php?user_id=<?php echo $user_id; ?>" class="nav__link_menu">Groups</a>
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
            id="user_url"
            alt="account photo"
            class="side__photo"
          />

          <div class="side__name">Name : <p id="username"> EXAMPLE OF NAME</p></div>
          <div class="side__date">Member since: <p id="user_date_of_creation">EXAMPLE OF DATE</p></div>
          <div class="side__books">Nr of books : 24</div>
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
         
          <div class="main__groups">
           <p class="group_list_name">Groups!</p>
          <ul class="group__list" id="group__list">
          </ul>
           </div>

          <div class="about__me__section">
            <div class="section">
              <p class="section__type">Interests</p>
              <p id="user_description">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Quibusdam error eum nihil libero atque est laudantium iste
                voluptas. Explicabo et voluptatem placeat impedit nisi officia
                nam distinctio iste veniam blanditiis tempora porro, recusandae
                ea, enim labore. Ut odio quod nemo!
              </p>
            </div>
            <div class="section">
              <p class="section__type">About me:</p>
              <p  id="user_tips">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quibusdam optio iste dolorem repellendus dicta magnam possimus
                quod amet eaque? Possimus reiciendis magnam, magni sed nostrum
                maiores aperiam. Placeat, saepe magnam.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
