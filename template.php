<?php
function showAllBoxes($tableName, $query, $relatedFile)
{ ?>
  <section class="all-books">
    <?php
    require 'config.php';
    $select_all_rows = mysqli_query($conn, $query) or die('query failed');

    // Define the total number of rows
    $totalBoxes = mysqli_num_rows($select_all_rows);

    // Define the number of box(book, author, ..) per page
    $boxesPerPage = 10;

    // Calculate the total number of pages
    $totalPages = ceil($totalBoxes / $boxesPerPage);

    // Get the current page number from the URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page = max(1, $page); // Ensure page is within valid range

    // Calculate the offset for the SQL query
    $offset = ($page - 1) * $boxesPerPage;

    // Select boxes for the current page using LIMIT
    $select_current_boxes = mysqli_query($conn, "$query LIMIT $offset, $boxesPerPage") or die('query failed');
    ?>

    <!-- Display the boxes for the current page -->
    <div class='box-container'>
      <?php
      if ($totalBoxes > 0) {
        while ($currentBoxes = mysqli_fetch_assoc($select_current_boxes)) {
      ?>
          <div class='box'>
          <div class="image">
              <?php if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == null)) { ?>
                <a href="<?php echo $relatedFile; ?>?id=<?php echo $currentBoxes['id'] ?>">
                  <img src='<?php echo "admin/uploaded_image/" . $currentBoxes['image']; ?>' alt="">
                </a>
                <div class="fav">
                  <button onclick="toggleFavorite(<?php echo $currentBoxes['id']; ?>)">
                    <i class="fa fa-heart"></i>
                  </button>
                </div>
              <?php } else { ?>
                <img src='<?php echo "uploaded_image/" . $currentBoxes['image']; ?>' alt="">
              <?php } ?>
            </div>


            <div class="text">
              <p><?php echo $currentBoxes['name'] ?></p>
              <?php if ($tableName == 'books') { ?>
                <p><?php echo "نووسەر: " . $currentBoxes['author'] ?></p>
                <p><?php echo "چەشن: " . $currentBoxes['category'] ?></p>
              <?php } ?>
            </div>

            <?php if (!($tableName == 'authors')) { ?>
              <div class="buttons">
                <?php if (!isset($_SESSION['user_type']) || (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'user')) { ?>
                  <a href="<?php echo "admin/uploaded_files/" . $currentBoxes['file']; ?>" class="reading-button" target="_blank">خوێندنەوە</a>
                  <a href="<?php echo $currentBoxes['file']; ?>" download class="download-button">دابەزاندن</a>

                <?php } else if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') { ?>
                  <a href="<?php echo $tableName . '.php?update=' . $currentBoxes['id']; ?>" class="edit-button">دەستکاریکردن</a>
                  <a href="<?php echo $tableName . '.php?delete=' . $currentBoxes['id']; ?>" class="delete-button" onclick="return confirm('Are You Sure?')">سڕینەوە</a>
                <?php } ?>
              </div>
              <?php } else {
              if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') { ?>
                <div class="buttons">
                  <a href="<?php echo $tableName . '.php?update=' . $currentBoxes['id']; ?>" class="edit-button">دەستکاریکردن</a>
                  <a href="<?php echo $tableName . '.php?delete=' . $currentBoxes['id']; ?>" class="delete-button" onclick="return confirm('Are You Sure?')">سڕینەوە</a>
                </div>
            <?php }
            } ?>
          </div>
      <?php
        }
      }
      ?>
    </div>
    </div>

    <!-- Display pagination links -->
    <div class='pagination'>
      <?php
      // Previous link
      if ($page > 1) {
        echo "<a href='" . $tableName . ".php?page=" . ($page - 1) . "'>پێشتر</a> ";
      }

      // show page 1
      if ($totalPages > 0) {
        if ($page == 1) {
          echo "<span class='current'>1 </span>";
        } else {
          echo "<a href='" . $tableName . ".php?page=1'>1</a> ";
        }
      }

      if ($totalPages > 1) {
        // show page 2
        if ($page == 2) {
          echo "<span class='current'>2 </span>";
        } else {
          echo "<a href='" . $tableName . ".php?page=2'>2</a> ";
        }
      }

      // Calculate the start and end pages based on the current page
      $startPage = max(3, $page - 3);
      $endPage = min($totalPages - 2, $page + 3);

      // Show (...) if the start page is greater than 3
      if ($startPage > 3) {
        echo "... ";
      }

      // Display pages between startPage and endPage
      for ($i = $startPage; $i <= $endPage; $i++) {
        if ($i == $page) {
          echo "<span class='current'>$i</span> ";
        } else {
          echo "<a href='" . $tableName . ".php?page=$i'>$i</a> ";
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
          echo "<a href='" . $tableName . ".php?page=" . ($totalPages - 1) . "'>" . ($totalPages - 1) . "</a> ";
        }
      }

      // show last page
      if ($totalPages > 2) {
        if ($page == $totalPages) {
          echo "<span class='current'>$totalPages </span>";
        } else {
          echo "<a href='" . $tableName . ".php?page=$totalPages'>$totalPages</a> ";
        }
      }

      // Next link
      if ($page < $totalPages) {
        echo "<a href='" . $tableName . ".php?page=" . ($page + 1) . "'>دواتر</a> ";
      }
      ?>
    </div>

  </section>
<?php } ?>