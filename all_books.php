<?php
  include 'config.php';
?>

<!DOCTYPE html>
<html lang="ckb">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>هەموو کتێبەکان</title>
  <link rel="stylesheet" href="css/styles.css">
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
      ?>

    <!-- Display the books for the current page -->
    <div class='box-container'>
      <?php
        if($totalBooks > 0){
          while($currentBooks = mysqli_fetch_assoc($select_current_books)){
        ?>
      <div class='box'>
        <div class="image">
          <?php echo '<a href="book_details.php?id=' . $currentBooks['book_id'] . '"><img src="uploaded_image/patata_xorakan.jpg" alt=""></a>'; ?>
        </div>

        <div class="text">
          <p><?php echo $currentBooks['book_name']?></p>
          <p><?php echo "نووسەر: " . $currentBooks['book_author']?></p>
        </div>

        <div class="buttons">
          <a href="js/Literature Review.pdf" class="reading-button">خوێندنەوە</a>
          <a href="" download="test" class="download-button">دابەزاندن</a>
        </div>
        
      </div>
      <?php
          }
        }
          ?>
    </div>

    <!-- Display pagination links -->
    <div class='pagination'>
      <?php
        // Previous link
        if ($page > 1) {
          echo "<a href='all_books.php?page=" . ($page - 1) . "'>پێشتر</a> ";
        }

        if($totalPages > 1) {
          // show page 1
          if($page == 1) {
            echo "<span class='current'>1 </span>";
          } else{
            echo "<a href='all_books.php?page=1'>1</a> ";
          }

        // show page 2
        if($page == 2) {
          echo "<span class='current'>2 </span>";
        } else{
          echo "<a href='all_books.php?page=2'>2</a> ";
        }
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
        if($totalPages > 3) {
          if($page == $totalPages - 1) {
            echo "<span class='current'>".($totalPages - 1)." </span>";
          } else{
            echo "<a href='all_books.php?page=" . ($totalPages - 1) . "'>" . ($totalPages - 1) . "</a> ";
          }
        }

        // show last page
        if($totalPages > 2) {
          if($page == $totalPages) {
            echo "<span class='current'>$totalPages </span>";
          } else{
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
    <iframe id="pdf-viewer" src="" type="application/pdf">
  </div>





  <!-- custom js file -->
  <script src='./js/scripts.js'></script>

</body>
</html>