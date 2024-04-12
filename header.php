<?php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- custom css style link-->
    <link rel="stylesheet" href="./css/header_style.css">
    <link rel="stylesheet" href="./css/styles.css">
    <!-- font awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <div class="header-1">
            <div class="flex">
                <div class="share">
                    <a href="#" class="fa fa-facebook-f"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-linkedin"></a>
                </div>
                <?php
                if (isset($_SESSION['user_name'])) {
                    echo '<p>Welcome ' . $_SESSION['user_name'] . '</p>';
                } else {
                ?>
                    <div class="login-register">
                        <a href="login.php">چوونەژوورەوە</a>
                        <a href="register.php">خۆتۆمارکردن</a>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="header-2">
            <div class="flex">
                <a href="home.php" class="logo">زانکورد.</a>

                <nav>
                    <ul>
                        <li>
                            <a href="home.php">سەرەتا</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" id="dropdown-link">کتێبەکان <i class="fa fa-angle-left" id="dropdown-link-icon"></i></a>

                            <div class="dropdown-menu-container" id="dropdown-menu-container">
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="all_books.php">هەموو</a>
                                    </li>
                                    <li>
                                        <a href="#">ڕۆمان</a>
                                    </li>
                                    <li>
                                        <a href="#">چیرۆک</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="authors.php">نووسەرەکان</a>
                        </li>
                        <li>
                            <a href="about.php">دەربارە</a>
                        </li>
                    </ul>
                </nav>

                <div class="search-container">
                    <form action="">
                        <input type="text" placeholder="گەڕان.." name="search">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="icons">
                    <a href="search_page.php" id="search-btn" class="fa fa-search"></a>
                    <div id="user-btn" class="fa fa-user"></div>
                    <div id="menu-btn" class="fa fa-bars"></div>
                </div>
            </div>

            <div id="user-box" class="user-box">
                <p>ناو : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>ئیمەیڵ : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <a href="logout.php" class="delete-button">چوونەدەرەوە</a>
            </div>
        </div>
    </header>

    <!-- custom js script link-->
    <script src="js/scripts.js"></script>
</body>

</html>