<?php
include '../config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if ($userType == 'user' || $userType == null) {
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نووسەرەکان</title>
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

<!-- add author form -->
  <section class="add-authors">
    <h1>زیادکردنی نووسەر</h1>
    <div class="form-container">
    <form action="authors.php" method="POST" enctype="multipart/form-data">

      <label for="name">ناوی نووسەر</label>
      <input type="text" name="name" class="field" required>

      <label for="image">وێنەی نووسەر</label>
      <input type="file" name="image" class="field" accept="image/jpg, image/jpeg, image/png" required>

      <label for="description">دەربارەی نووسەر</label>
      <input type="text" name="description" class="field" required>

      <button type="submit" name="add_author">زیادکردن</button>

    </form>
    </div>
  </section>

  <?php
  // add author functionallity
  if (isset($_POST['add_author'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    $description = mysqli_real_escape_string($conn, $_POST['description']);


    $select_author_name = mysqli_query($conn, "SELECT name FROM `authors` WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_author_name) > 0) {
      $message[] = 'نووسەرەکە پێشتر زیادکراوە.';
    } else {
      $add_author_query = mysqli_query($conn, "INSERT INTO `authors` (name, image, description)
    VALUES('$name', '$image', '$description')") or die('query failed');

      if ($add_author_query) {
        //lera 7isabi image size u shtm nakrdwa pewist nakat

        move_uploaded_file($image_tmp_name, 'uploaded_image/' . $image);
    

        $message[] = 'نووسەرەکە بە سەرکەوتوویی زیادکرا.';
      } else {
        $message[] = 'ناتوانیت نووسەرەکە زیاد بکەیت.';
      }
    }
  }
  
//showing authors
  require_once '../template.php';
  showAllBoxes('authors',"SELECT * FROM `authors`", "../author_details.php");
  ?>

<!-- update author form -->
  <section class="edit-author">
    
    <?php
    if (isset($_GET['update'])) {
      $update_id = $_GET['update'];
      $update_query = mysqli_query($conn, "SELECT * FROM `authors` WHERE id = '$update_id'") or die('query failed');
      if (mysqli_num_rows($update_query) > 0) {
        while ($fetch_update = mysqli_fetch_assoc($update_query)) {
    ?>
          <form action="authors.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="update_author_id" value="<?php echo $fetch_update['id']; ?>">

            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">

            <img src="uploaded_image/<?php echo $fetch_update['image']; ?>" alt="">

            <label for="update_author_name">ناوی نووسەر</label>
            <input type="text" name="update_author_name" value="<?php echo $fetch_update['name']; ?>" class="field" required placeholder="ناوی نووسەر">

            <label for="update_author_image">وێنەی نووسەر</label>
            <input type="file" name="update_author_image" class="field" accept="image/jpg, image/jpeg, image/png" required>

            <label for="update_author_description">دەربارەی نووسەر</label>
            <input type="text" name="update_author_description" value="<?php echo $fetch_update['description']; ?>" class="field" required placeholder="دەربارەی نووسەر"><br>

            <input type="submit" value="پاشەکەوتکردن" name="update_author" class="save-button"><br>
            <input type="reset" value="پاشگەزبوونەوە" id="close-update" class="cancel-button" onclick="(function() { document.querySelector('.edit-author').style.display = 'none'; })()">
        </form>
        <?php
        }
    }
    } else {
        echo '<script>document.querySelector(".edit-author").style.display = "none";</script>';
    }
    ?>
</section>

<?php
// update author functionallity
if (isset($_POST['update_author'])) {
    
    $update_author_id = $_POST['update_author_id'];
    $update_author_name = $_POST['update_author_name'];
  
    $update_author_image = $_FILES['update_author_image']['name'];
    $update_image_tmp_name = $_FILES['update_author_image']['tmp_name'];
    $update_old_image = $_POST['update_old_image'];

    $update_author_description = $_POST['update_author_description'];
  
    $update_author_query = mysqli_query($conn, "UPDATE `authors`
        SET
        name = '$update_author_name',
        image = '$update_author_image',
        description = '$update_author_description'
        WHERE id = '$update_author_id'") or die('query failed');
  
    if ($update_author_query) {
      move_uploaded_file($update_image_tmp_name, 'uploaded_image/' . $update_author_image);
      unlink('uploaded_image/' . $update_old_image);
      $message[] = 'نووسەرەکە بە سەرکەوتووی پاشەکەوتکرا.';
    }
    else {
      $message[] = 'ناتوانیت نووسەرەکە پاشەکەوت بکەیت.';
    }
    ?> <script> location.replace("authors.php"); </script>
      <?php }


  // delete author
  if (isset($_GET['delete'])) {
      $delete_id = $_GET['delete'];
      
      // delete author image
      $delete_image_query = mysqli_query($conn, "SELECT image FROM `authors` WHERE id = '$delete_id'") or die('query failed');
      $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
      
      if ($fetch_delete_image !== null && isset($fetch_delete_image['image'])) {
        unlink('uploaded_image/' . $fetch_delete_image['image']);
      }
           
      $delete_author_query = mysqli_query($conn, "DELETE FROM `authors` WHERE id = '$delete_id'") or die('query failed');
      if($delete_author_query){
        $message[] = 'نووسەرەکە سڕایەوە.';
      }
      else{
        $message[] = 'ناتوانیت نووسەرەکە بسڕیتەوە.';
      } ?> <script> location.replace("authors.php"); </script>
      <?php }?>
      
      

  <!-- custom js script link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>


  <!-- jquery cdn link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  <!-- custom js link-->
  <script src="../js/scripts.js"></script>

  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
</body>
</html>