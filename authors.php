<?php
  include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
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
<!-- using the same style of all-books -->
  <section class="all-books">

    <?php
      // Select all authors
      $select_all_authors = mysqli_query($conn, "SELECT * FROM authors") or die('Failed to select authors');
      
      // Define the total number of authors
      $totalAuthors = mysqli_num_rows($select_all_authors);

      // Define the number of authors per page
      $authorsPerPage = 10;

      // Calculate the total number of pages
      $totalPages = ceil($totalAuthors / $authorsPerPage);

      // Get the current page number from the URL
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $page = max(1, $page); // Ensure page is within valid range

      // Calculate the offset for the SQL query
      $offset = ($page - 1) * $authorsPerPage;

      // Select authors for the current page using LIMIT
      $select_current_authors = mysqli_query($conn, "SELECT * FROM authors LIMIT $offset, $authorsPerPage") or die('Failed to select authors');
      ?>

    <!-- Display the authors for the current page -->
    <div class='box-container'>
      <?php
        if($totalAuthors > 0){
          while($currentAuthors = mysqli_fetch_assoc($select_current_authors)){
        ?>
      <div class='box'>
        <div class="image">
          <?php echo '<a href="author_books.php?id=' . $currentAuthors['author_id'] . '"><img src="uploaded_image/patata_xorakan.jpg" alt=""></a>'; ?>
        </div>
        <div class="text">
          <p><?php echo $currentAuthors['author_name']?></p>
        </div>
        <!-- <a href="" download="test" class="download-button">دابەزاندن</a> -->
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
          echo "<a href='authors.php?page=" . ($page - 1) . "'>پێشتر</a> ";
        }

        if($totalPages > 1) {
          // show page 1
          if($page == 1) {
            echo "<span class='current'>1 </span>";
          } else{
            echo "<a href='authors.php?page=1'>1</a> ";
          }

        // show page 2
        if($page == 2) {
          echo "<span class='current'>2 </span>";
        } else{
          echo "<a href='authors.php?page=2'>2</a> ";
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
                echo "<a href='authors.php?page=$i'>$i</a> ";
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
            echo "<a href='authors.php?page=" . ($totalPages - 1) . "'>" . ($totalPages - 1) . "</a> ";
          }
        }


// show last page
        if($totalPages > 2) {
          if($page == $totalPages) {
            echo "<span class='current'>$totalPages </span>";
          } else{
            echo "<a href='authors.php?page=$totalPages'>$totalPages</a> ";
          }
        }
        
        // Next link
        if ($page < $totalPages) {
            echo "<a href='authors.php?page=" . ($page + 1) . "'>دواتر</a> ";
        }
        ?>
    </div>

  </section>


  <!-- custom js file -->
  <script src="js/scripts.js"></script>

</body>
</html>