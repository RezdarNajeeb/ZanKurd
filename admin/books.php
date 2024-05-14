<?php
include '../config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if ($userType == 'user' || $userType == null) {
  header('location: ../logout.php');
}

?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>کتێبەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/header_style.css">
  <link rel="stylesheet" href="../css/admin_style.css">
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php

  include 'admin_header.php';
  ?>

  <!-- add book form -->
  <section class="add-books">
    <h1>زیادکردنی کتێب</h1>
    <div class="form-container">
      <form action="books.php" method="POST" enctype="multipart/form-data">
        <label for="book_name">ناوی کتێب</label>
        <input type="text" name="book_name" class="field" required>

        <label for="author_name">نووسەر</label>
        <input type="text" name="author_name" class="field" required>

        <label for="category">چەشن</label>
        <?php include '../categories.php' ?>

        <label for="book_image">بەرگ</label>
        <input type="file" name="image" class="field" accept="image/jpg, image/jpeg, image/png" required>

        <label for="book_file">فایل</label>
        <input type="file" name="file" class="field" accept="application/pdf" required>

        <label for="description">دەربارەی کتێب</label>
        <input type="text" name="description" class="field" required>

        <button type="submit" name="add_book">زیادکردن</button>
      </form>
    </div>
  </section>

  <?php
  // add book functionallity
  if (isset($_POST['add_book'])) {
    $name = mysqli_real_escape_string($conn, $_POST['book_name']);

    $author = mysqli_real_escape_string($conn, $_POST['author_name']);

    $category = mysqli_real_escape_string($conn, $_POST['category']);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    $file = $_FILES['file']['name'];
    $file_tmp_name = $_FILES['file']['tmp_name'];

    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $select_book_name = mysqli_query($conn, "SELECT name FROM `books` WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_book_name) > 0) {
      $message[] = 'کتێبەکە پێشتر زیادکراوە.';
    } else {
      $add_book_query = mysqli_query($conn, "INSERT INTO `books`(name, author, category, image, file, description)
    VALUES('$name', '$author', '$category', '$image', '$file', '$description')") or die('query failed');

      if ($add_book_query) {

        //adding author
        mysqli_query($conn, "INSERT INTO `authors`(name)
      VALUES('$author')") or die('query failed');

        //lera 7isabi image size u shtm nakrdwa pewist nakat
        move_uploaded_file($image_tmp_name, 'uploaded_image/' . $image);
        move_uploaded_file($file_tmp_name, 'uploaded_files/' . $file);

        $message[] = 'کتێبەکە بە سەرکەوتوویی زیادکرا.';
      } else {
        $message[] = 'ناتوانیت کتێبەکە زیاد بکەیت.';
      }
    }
  }

  //showing books
  include '../template.php';

  $title = isset($_GET['title']) ? $_GET['title'] : 'all';
  $query = "SELECT * FROM `books`";
  if ($title !== 'all') {

    switch ($title) {
      case 'novels':
        $title = 'ڕۆمان';
        break;
      case 'poetries':
        $title = 'شیعر';
        break;
      case 'stories':
        $title = 'چیرۆک';
        break;
      case 'politics':
        $title = 'سیاسی';
        break;
      case 'sciences':
        $title = 'زانست';
        break;
      case 'arts':
        $title = 'هونەر';
        break;
    }

    $query = "SELECT * FROM `books` WHERE `category`='$title'";
  }

  showAllBoxes('books', $query, "../book_details.php");
  ?>

  <!-- update book form -->
  <section class="edit-book">
    <?php
    if (isset($_GET['update'])) {
      $update_id = $_GET['update'];
      $update_query = mysqli_query($conn, "SELECT * FROM `books` WHERE id = '$update_id'") or die('query failed');
      if (mysqli_num_rows($update_query) > 0) {
        while ($fetch_update = mysqli_fetch_assoc($update_query)) {
    ?>
          <form action="books.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="update_book_id" value="<?php echo $fetch_update['id']; ?>">

            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">

            <input type="hidden" name="update_old_file" value="<?php echo $fetch_update['file']; ?>">


            <img src="uploaded_image/<?php echo $fetch_update['image']; ?>" alt="">

            <label for="update_book_name">ناوی کتێب</label>
            <input type="text" name="update_book_name" value="<?php echo $fetch_update['name']; ?>" class="field" required placeholder="ناوی کتێب">

            <label for="author">نووسەر</label>
            <input type="text" name="update_book_author" value="<?php echo $fetch_update['author']; ?>" class="field" required placeholder="ناوی نووسەر">

            <label for="category">چەشن</label>
            <?php include '../categories.php' ?>


            <label for="update_book_image">بەرگ</label>
            <input type="file" name="update_book_image" class="field" accept="image/jpg, image/jpeg, image/png" required>

            <label for="update_book_file">فایل</label>
            <input type="file" name="update_book_file" class="field" accept="application/pdf" required>

            <label for="description">دەربارەی کتێب</label>
            <input type="text" name="update_book_description" class="field" required placeholder="دەربارەی نووسەر"><br>

            <input type="submit" value="پاشەکەوتکردن" name="update_book" class="save-button"><br>
            <input type="reset" value="پاشگەزبوونەوە" id="close-update" class="cancel-button">
          </form>
    <?php
        }
      }
    } else {
      echo '<script>document.querySelector(".edit-book").style.display = "none";</script>';
    }
    ?>

  </section>

  <?php

  // update book functionallity
  if (isset($_POST['update_book'])) {

    $update_book_id = $_POST['update_book_id'];
    $update_book_name = $_POST['update_book_name'];
    $update_book_author = $_POST['update_book_author'];
    $update_book_category = $_POST['category'];
    $update_book_description = $_POST['update_book_description'];

    
    $update_book_image = $_FILES['update_book_image']['name'];
    $update_image_tmp_name = $_FILES['update_book_image']['tmp_name'];
    $update_old_image = $_POST['update_old_image'];

    $update_book_file = $_FILES['update_book_file']['name'];
    $update_book_file_tmp_name = $_FILES['update_book_file']['tmp_name'];
    $update_old_file = $_POST['update_old_file'];

    $update_book_query = mysqli_query($conn, "UPDATE `books`
        SET
        name = '$update_book_name',
        author = '$update_book_author',
        category = '$update_book_category',
        image = '$update_book_image',
        file = '$update_book_file',
        description = '$update_book_description'
        WHERE id = '$update_book_id'") or die('query failed');

    if ($update_book_query) {
      move_uploaded_file($update_image_tmp_name, 'uploaded_image/' . $update_book_image);
      move_uploaded_file($update_book_file_tmp_name, 'uploaded_files/' . $update_book_file);
      unlink('uploaded_image/' . $update_old_image);
      unlink('uploaded_files/' . $update_old_file);
    }
    header('refresh:0;url=./books.php');
  }



  // delete book
  if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // delete book image
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `books` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_image/' . $fetch_delete_image['image']);

    // delete book file
    $delete_file_query = mysqli_query($conn, "SELECT file FROM `books` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_file = mysqli_fetch_assoc($delete_file_query);
    unlink('uploaded_files/' . $fetch_delete_file['file']);

    mysqli_query($conn, "DELETE FROM `books` WHERE id = '$delete_id'") or die('query failed');
    header('refresh:0;url=./books.php');
  }
  ?>

  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
  <!-- jquery cdn link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- custom js script link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="../js/scripts.js"></script>

</body>

</html>