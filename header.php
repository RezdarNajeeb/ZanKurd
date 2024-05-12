<header>
    <div class="header-1">
        <div class="flex">
            <?php
            if (isset($_SESSION['user_name'])) {
                echo '<p>بەخێربێی <span>' . $_SESSION['user_name'] . '</span></p>';
            } else {
            ?>
                <div class="login-register">
                    <a href="login.php">چوونەژوورەوە</a>
                    <a href="register.php">خۆتۆمارکردن</a>
                </div>
            <?php } ?>
            <div class="share">
                <a href="https://www.facebook.com/rez.dar.10?mibextid=ZbWKwL" class="fa fa-facebook-f"></a>
                <a href="https://www.instagram.com/_rezdar_?igsh=bjFxcWJ6aThkMWp2" class="fa fa-instagram"></a>
                <a href="https://www.linkedin.com/in/rezdar-n-obaed-52b794241?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="fa fa-linkedin"></a>
            </div>

        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="index.php" class="logo">زانکورد</a>

            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>

            <nav>
                <ul id="nav" class="nav">
                    <li>
                        <a href="index.php" <?php if ($current_page === 'index.php') echo 'class="active"'; ?>>سەرەتا</a>
                    </li>
                    <li>
                        <a href="books.php" id="dropdown-link" <?php if ($current_page === 'books.php') echo 'class="active"' ?>>کتێبەکان <i class="fa fa-angle-left" id="dropdown-link-icon"></i></a>

                        <div class="dropdown-menu-container" id="dropdown-menu-container">
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="books.php" id="all-books-link">هەموو</a>
                                </li>

                                <?php
                                include 'categories.php';

                                echo '<script> document.getElementById("category").style.display = "none"; </script>';

                                foreach ($categories as $category) {
                                    $title = strtolower(str_replace(' ', '-', $category)); // Convert category name to lowercase and replace spaces with hyphens
                                    switch ($title) {
                                        case 'ڕۆمان':
                                            $title = 'novels';
                                            break;
                                        case 'شیعر':
                                            $title = 'poetries';
                                            break;
                                        case 'چیرۆک':
                                            $title = 'stories';
                                            break;
                                        case 'سیاسی':
                                            $title = 'politics';
                                            break;
                                        case 'زانست':
                                            $title = 'sciences';
                                            break;
                                        case 'هونەر':
                                            $title = 'arts';
                                            break;
                                    }
                                    echo "<li><a href='books.php?title=$title'>$category</a></li>";
                                } ?>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="authors.php" <?php if ($current_page === 'authors.php') echo 'class="active"'; ?>>نووسەرەکان</a>
                    </li>
                    <li>
                        <a href="about.php" <?php if ($current_page === 'about.php') echo 'class="active"'; ?>>دەربارە</a>
                    </li>
                </ul>
            </nav>


            <div class="search-container" id="search-container">
                <form action="">
                    <input type="text" placeholder="گەڕان.." name="search">
                    <i class="fa fa-search"></i>
                </form>
            </div>

            <div class="icons">
                <a href="#" id="search-btn" class="fa fa-search search-btn"></a>
                <div id="user-btn" class="fa fa-user"></div>
                <div id="menu-btn" class="fa fa-bars menu-btn"></div>
            </div>
        </div>

        <div id="user-box" class="user-box">
            <p>ناو : <span><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?></span></p>
            <p>ئیمەیڵ : <span><?php echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''; ?></span></p>
            <a href="logout.php" class="delete-button">چوونەدەرەوە</a>
        </div>

        <div id="blur-effect" class="blur-effect"></div>
    </div>
</header>

<div class="scroll-to-top-container">
    <i class="fa fa-caret-up"></i>
</div>

<div class="loader-background" id="loader-background"></div>
<i class="fa-solid fa-book fa-fade" id="loader-icon"></i>

<?php 
 if (isset($messages)) {
    foreach ($messages as $message) {
      echo '
        <div class="message">
           <span>' . $message . '</span>
           <i class="fa fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
  }
?>