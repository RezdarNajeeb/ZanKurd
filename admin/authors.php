<?php
include 'admin_header.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login.php');
}

if (isset($_POST['add_author'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);



    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];


    $select_author_name = mysqli_query($conn, "SELECT name FROM `authors` WHERE author_name = '$name'") or die('شکستی هێنا');

    if (mysqli_num_rows($select_book_name) > 0) {
        $message[] = 'نووسەرەکە پێشتر زیادکراوە.';
    } else {
        $add_author_query = mysqli_query($conn, "INSERT INTO `authors`(author_name, author_image)
    VALUES('$name', '$image')") or die('شکستی هێنا');

        if ($add_author_query) {
            //lera 7isabi image size u shtm nakrdwa pewist nakat

            move_uploaded_file($image_tmp_name, 'authors_images/' . $image);
        

            $message[] = 'نووسەرەکە بە سەرکەوتوویی زیادکرا.';

        } else {
            $message[] = 'ناتوانیت نووسەرەکە زیاد بکەیت.';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- custom css style link-->
    <link rel="stylesheet" href="css/styles.css">
    <!-- font awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- same style of form, using add-books class -->
    <section class="add-books"> 

        <h1>زیادکردنی نووسەر</h1>
        <form action="add_author.php" method="POST" enctype="multipart/form-data">

            <label for="book_name">ناوی نووسەر</label>
            <input type="text" name="book_name" required>

            <label for="book_image">وێنەی نووسەر</label>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" >

            <button type="submit" name="add_author">زیادکردن</button>
        </form>
    </section>

</body>

</html>