<header>
    <div class="header-1">
        <div class="flex">
            <div class="search-container" id="search-container">
                <form action="">
                    <input type="text" placeholder="گەڕان.." id="search-input" name="search">
                    <i class="fa fa-search"></i>
                    <div id="search-results"></div>
                </form>
            </div>

            <div class="share">
                <a href="#" class="fa fa-facebook-f"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-linkedin"></a>
            </div>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="dashboard.php" class="logo">بەڕێوەبردن</a>

            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>

            <nav>
                <ul id="nav" class="nav">
                    <li>
                        <a href="dashboard.php" <?php if ($current_page === 'dashboard.php') echo 'class="active"' ?>>زانیاریەکان</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" id="dropdown-link" <?php if ($current_page === 'books.php') echo 'class="active"' ?>>کتێبەکان <i class="fa fa-angle-left" id="dropdown-link-icon"></i></a>

                        <div class="dropdown-menu-container" id="dropdown-menu-container">
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="books.php" id="all-books-link">هەموو</a>
                                </li>
                                <?php
                                include '../categories.php';

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
                        <a href="authors.php" <?php if ($current_page === 'authors.php') echo 'class="active"' ?>>نووسەرەکان</a>
                    </li>
                    <li>
                        <a href="contacts.php" <?php if ($current_page === 'contacts.php') echo 'class="active"' ?>>نامەکان</a>
                    </li>
                    <li>
                        <a href="users.php" <?php if ($current_page === 'users.php') echo 'class="active"' ?>>بەکارهێنەرەکان</a>
                    </li>
                </ul>
            </nav>

            <div class="icons">
                <a href="#" id="search-btn" class="fa fa-search search-btn"></a>
                <div id="user-btn" class="fa fa-user"></div>
                <div id="menu-btn" class="fa fa-bars menu-btn"></div>
            </div>
        </div>

        <div id="user-box" class="user-box">
            <p>ناو : <span><?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : ''; ?></span></p>
            <p>ئیمەیڵ : <span><?php echo isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : ''; ?></span></p>
            <a href="../logout.php" class="delete-button">چوونەدەرەوە</a>
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