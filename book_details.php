<?php 
include 'config.php';
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Details</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <?php
    $selected_id = $_GET['id'];
    
    $select_book = mysqli_query($conn, "SELECT * FROM books WHERE book_id = $selected_id") or die ("Failed to select book");

    $book_details = mysqli_fetch_assoc($select_book);
  ?>

  <section class="book_details">
    <div class="book_details-container">
      <div class="book_details-image">
        <?php echo '<img src="uploaded_image/' . $book_details['book_image'] . '" alt="">' ?>
      </div>
      <div class="book_details-text">
        <h1><?php echo $book_details['book_name'] ?></h1>
        <p><?php echo "نووسەر: " . $book_details['book_author'] ?></p>
      </div>
    </div>
  </section>

</body>

</html>