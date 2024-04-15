<?php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>هەموو کتێبەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/header_style.css">
  <!-- font awesome cdn-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>

  <?php
  include 'header.php';
  ?>


  <section class="all-books">

    <?php
    // Select all books
    $select_all_books = mysqli_query($conn, "SELECT * FROM books") or die('Failed to select books');

    // Define the total number of books
    $totalBooks = mysqli_num_rows($select_all_books);

    // Select all books
    $select_all_books = mysqli_query($conn, "SELECT * FROM `books`") or die('Failed to select books');

    // Define the total number of books
    $totalBooks = mysqli_num_rows($select_all_books);

    // Define the number of books per page
    $booksPerPage = 10;

    // Calculate the total number of pages
    $totalPages = ceil($totalBooks / $booksPerPage);

    // Get the current page number from the URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page = max(1, $page); // Ensure page is within valid range

    // Calculate the offset for the SQL query
    $offset = ($page - 1) * $booksPerPage;

    // Select books for the current page using LIMIT
    $select_current_books = mysqli_query($conn, "SELECT * FROM `books` LIMIT $offset, $booksPerPage") or die('Failed to select books');




    // delete book
    if (isset($_GET['delete'])) {
      $delete_id = $_GET['delete'];

      // delete book image
      $delete_image_query = mysqli_query($conn, "SELECT book_image FROM `books` WHERE id = '$delete_id'") or die('query failed');
      $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
      unlink('uploaded_image/' . $fetch_delete_image['book_image']);

      // delete book file
      $delete_file_query = mysqli_query($conn, "SELECT book_file FROM `books` WHERE id = '$delete_id'") or die('query failed');
      $fetch_delete_file = mysqli_fetch_assoc($delete_file_query);
      unlink('uploaded_files/' . $fetch_delete_image['book_file']);

      mysqli_query($conn, "DELETE FROM `books` WHERE id = '$delete_id'") or die('query failed');
      header('location:all_books.php');
    }




    // update book
    if (isset($_POST['update_book'])) {

      $update_book_id = $_POST['update_id'];
      $update_book_name = $_POST['update_book_name'];
      $update_book_author = $_POST['update_book_author'];
      $update_book_category = $_POST['category'];

      $update_book_image = $_FILES['update_book_image']['name'];
      $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
      $update_old_image = $_POST['update_old_image'];

      $update_book_file = $_FILES['update_book_file']['name'];
      $update_book_file_tmp_name = $_FILES['update_file']['tmp_name'];
      $update_old_file = $_POST['update_old_image'];

      $update_book_query = mysqli_query($conn, "UPDATE `books`
      SET
      book_name = '$update_book_name',
      book_author = '$update_book_author',
      category = $update_book_category,
      book_image = '$update_book_image',
      book_file = '$update_book_file'
      WHERE id = '$update_id'") or die('query failed');

      if ($update_book_query) {
        move_uploaded_file($update_image_tmp_name, 'uploaded_image/' . $update_book_image);
        move_uploaded_file($update_book_file_tmp_name, 'uploaded_files/' . $update_book_file);
        unlink('uploaded_image/' . $update_old_image);
        unlink('uploaded_files/' . $update_old_file);
      }
      header('location:all_books.php');
    }

    // Select books for the current page using LIMIT
    $select_current_books = mysqli_query($conn, "SELECT * FROM books LIMIT $offset, $booksPerPage") or die('Failed to select books');
    ?>

    <!-- Display the books for the current page -->
    <div class='box-container'>
      <?php
      if ($totalBooks > 0) {
        while ($currentBooks = mysqli_fetch_assoc($select_current_books)) {
      ?>
          <div class='box'>
            <div class="image"> <!-- showing the book image -->
              <a href="book_details.php?id=<?php echo $currentBooks['book_id'] ?>"><img src="uploaded_image/<?php echo $currentBooks['book_image'] ?>" alt=""></a>
            </div>

            <div class="text">
              <p><?php echo $currentBooks['book_name'] ?></p>
              <p><?php echo "نووسەر: " . $currentBooks['book_author'] ?></p>
            </div>

            <div class="buttons">
              <?php if (true) { ?>
                <a href="all_books.php?update=<?php echo $currentBooks['book_id']; ?>" class="edit-button">دەستکاری کردن</a>
                <a href="all_books.php?delete=<?php echo $currentBooks['book_id']; ?>" class="delete-button" onclick="return confirm('Are You Sure?')">سڕینەوە</a>


              <?php } else { ?>

                <a href="js/Literature Review.pdf" class="reading-button">خوێندنەوە</a>
                <a href="" download="test" class="download-button">دابەزاندن</a>

              <?php } ?>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
    </div>






    <section class="edit-book-form">

      <?php
      if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `books` WHERE book_id = '$update_id'") or die('query failed');
        if (mysqli_num_rows($update_query) > 0) {
          while ($fetch_update = mysqli_fetch_assoc($update_query)) {
      ?>
            <form action="" method="post" enctype="multipart/form-data">

              <input type="hidden" name="update_book_id" value="<?php echo $fetch_update['book_id']; ?>">

              <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['book_image']; ?>">

              <input type="hidden" name="update_old_file" value="<?php echo $fetch_update['book_file']; ?>">


              <img src="uploaded_image/<?php echo $fetch_update['book_image']; ?>" alt="">

              <label for="update_book_name">ناوی کتێب</label>
              <input type="text" name="update_book_name" value="<?php echo $fetch_update['book_name']; ?>" class="box" required placeholder="ناوی کتێب">

              <label for="author">نووسەر</label>
              <input type="text" name="update_author_name" value="<?php echo $fetch_update['author_name']; ?>" class="box" required placeholder="ناوی نووسەر">

              <label for="category">ژانەر</label>
              <?php include 'categories.php' ?>


              <label for="update_book_image">بەرگ</label>
              <input type="file" name="update_book_image" class="box" accept="image/jpg, image/jpeg, image/png" required>

              <label for="update_book_file">فایل</label>
              <input type="file" name="update_book_file" class="box" accept="application/pdf" required>


              <input type="submit" value="پاشەکەوتکردن" name="update_book" class="btn">
              <input type="reset" value="پاشگەزبوونەوە" id="close-update" class="option-btn">
            </form>
      <?php
          }
        }
      } else {
        echo '<script>document.querySelector(".edit-book-form").style.display = "none";</script>';
      }
      ?>

    </section>







    <!-- Display pagination links -->
    <div class='pagination'>
      <?php
      // Previous link
      if ($page > 1) {
        echo "<a href='all_books.php?page=" . ($page - 1) . "'>پێشتر</a> ";
      }

      if ($totalPages > 1) {
        // show page 1
        if ($page == 1) {
          echo "<span class='current'>1 </span>";
        } else {
          echo "<a href='all_books.php?page=1'>1</a> ";
        }
      }

      // show page 2
      if ($page == 2) {
        echo "<span class='current'>2 </span>";
      } else {
        echo "<a href='all_books.php?page=2'>2</a> ";
      }

      // Calculate the start and end pages based on the current page
      $startPage = max(3, $page - 3);
      $endPage = min($totalPages - 2, $page + 3);

      // Show (...) if the start page is not 3
      if ($startPage > 3) {
        echo "... ";
      }

      // Display pages between startPage and endPage
      for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $page) {
          echo "<span class='current'>$i</span> ";
        } else {
          echo "<a href='all_books.php?page=$i'>$i</a> ";
        }
      }

      // Show (...) if there are more pages after endPage
      if ($endPage < $totalPages - 2) {
        echo "... ";
      }

      // show second to last page
      if ($totalPages > 3) {
        if ($page == $totalPages - 1) {
          echo "<span class='current'>" . ($totalPages - 1) . " </span>";
        } else {
          echo "<a href='all_books.php?page=" . ($totalPages - 1) . "'>" . ($totalPages - 1) . "</a> ";
        }
      }


      // show last page
      if ($totalPages > 2) {
        if ($page == $totalPages) {
          echo "<span class='current'>$totalPages </span>";
        } else {
          echo "<a href='all_books.php?page=$totalPages'>$totalPages</a> ";
        }
      }

      // Next link
      if ($page < $totalPages) {
        echo "<a href='all_books.php?page=" . ($page + 1) . "'>دواتر</a> ";
      }
      ?>
    </div>

  </section>

  <div id="pdf-container">

  </div>

  <!-- custom js file -->
  <script src="js/scripts.js" defer></script>

</body>

</html>