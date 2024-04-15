<?php
include '../config.php';

include 'admin_header.php';



if (isset($_POST['add_book'])) {
    $name = mysqli_real_escape_string($conn, $_POST['book_name']);

    $author = mysqli_real_escape_string($conn, $_POST['author']);

    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_image/' . $image;

    $file = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_folder = 'uploaded_files/' . $file;

    $select_book_name = mysqli_query($conn, "SELECT book_name FROM `books` WHERE book_name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_book_name) > 0) {
        $message[] = 'کتێبەکە پێشتر زیادکراوە.';
    } else {
        $add_book_query = mysqli_query($conn, "INSERT INTO `books`(book_name, book_author, book_category, book_image, book_file)
    VALUES('$name', '$author', '$category', '$image', '$file')") or die('query failed');

        if ($add_book_query) {
            //lera 7isabi image size u shtm nakrdwa pewist nakat

            move_uploaded_file($image_tmp_name, '../uploaded_files/' . $image);
            move_uploaded_file($file_tmp_name, '../uploaded_files/' . $file);

            $message[] = 'کتێبەکە بە سەرکەوتوویی زیادکرا.';

        } else {
            $message[] = 'ناتوانیت کتێبەکە زیاد بکەیت.';
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
    <link rel="stylesheet" href="css/header_style.css">
    <!-- font awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <section class="add-books">
        <h1>زیادکردنی کتێب</h1>
        <form action="add_book.php" method="POST" enctype="multipart/form-data">
            <label for="book_name">ناو</label>
            <input type="text" name="book_name" required>

            <label for="author">نووسەر</label>
            <input type="text" name="author" class="box" required>

            <label for="category">ژانەر</label>
            <input type="text" name="category" class="box" required>

            <label for="book_image">بەرگ</label>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>

            <label for="book_file">فایل</label>
            <input type="file" name="file" class="box" accept="application/pdf" required>

            <button type="submit" name="add_book">زیادکردن</button>
        </form>
    </section>

</body>

</html>