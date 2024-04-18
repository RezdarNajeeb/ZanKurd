<header>
    <div class="header-1">
        <div class="flex">
            <div class="search-container" id="search-container">
                <form action="">
                    <input type="text" placeholder="گەڕان.." name="search">
                    <i class="fa fa-search"></i>
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
            <nav>
                <ul id="nav" class="nav">
                    <li>
                        <a href="dashboard.php">زانیاریەکان</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" id="dropdown-link">کتێبەکان <i class="fa fa-angle-left" id="dropdown-link-icon"></i></a>

                        <div class="dropdown-menu-container" id="dropdown-menu-container">
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="books.php" id="all-books-link">هەموو</a>
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
                        <a href="contacts.php">نامەکان</a>
                    </li>
                    <li>
                        <a href="users.php">بەکارهێنەرەکان</a>
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