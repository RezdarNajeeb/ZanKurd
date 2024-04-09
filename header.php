<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- custom css style link-->
    <link rel="stylesheet" href="./css/header_style.css">
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
                <p>
                    <a href="login.php">چوونەژوورەوە</a> | <a href="register.php">دروستکردنی هەژمار</a>
                </p>
            </div>
        </div>

        <div class="header-2">
            <div class="flex">
                <a href="home.php" class="logo">زانکورد.</a>

                <nav>
                    <a href="home.php">سەرەتا</a>
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">کتێبەکان</a>
                        <div class="dropdown-content">
                            <a href="all_books.php">هەموو</a>
                            <a href="#">ڕۆمان</a>
                            <a href="#">چیرۆک</a>
                        </div>
                    </div>
                    



                    <a href="authors.php">نووسەرەکان</a>
                    <a href="about.php">دەربارە</a>
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
                    <div id="menu-btn" class="fa fa-bars"></div>
                    <a href="search_page.php" class="fa fa-search"></a>
                    <div id="user-btn" class="fa fa-user"></div>
                </div>

                <div class="user-box">
                    <p>ناو : <span></span></p>
                    <p>ئیمەیڵ : <span></span></p>
                    <a href="logout.php" class="delete-btn">چوونەدەرەوە</a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>