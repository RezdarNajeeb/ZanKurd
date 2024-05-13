<?php
include '../config.php';
session_start();

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;

if ($userType == 'user' || $userType == null) {
  header('location: ../logout.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="ckb" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نامەکان</title>
  <!-- custom css style link-->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/header_style.css">
  <link rel="stylesheet" href="../css/admin_style.css">
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

  <?php require_once 'admin_header.php'; ?>

  <h1 id="messages_heading">نامەکان</h1>
  <div class="message_container">

    <?php
    if (isset($_POST['delete'])) {
      $id = $_POST['id'];
      $delete_message_query = mysqli_query($conn, "DELETE FROM contacts WHERE id=$id");
      if ($delete_message_query) {
        $message[] = 'پەیامەکە سڕایەوە.';
      } else {
        $message[] =  'ناتوانیت پەیامەکە بسڕیتەوە';
      }
    }

    if (isset($_POST['read'])) {
      $id = $_POST['id'];
      $update_state_query = mysqli_query($conn, "UPDATE contacts SET state='read' WHERE id=$id");
      if ($update_state_query) {
        $message[] = 'پەیامەکە زیادکرا بۆ خوێندراوەکان.';
      } else {
        $message[] =  'ناتوانیت پەیامەکە زیاد بکەیت بۆ خوێندراوەکان.';
      }
    }

    $select_all_rows = mysqli_query($conn, "SELECT * FROM contacts");
    $totalMessages = mysqli_num_rows($select_all_rows);
    if ($totalMessages > 0) {
      while ($currentMessages = mysqli_fetch_assoc($select_all_rows)) {
    ?>
        <div class="message_box">
          <h1><?php echo $currentMessages['user_name'] ?></h1>
          <h2><?php echo $currentMessages['user_email'] ?></h2>
          <p><?php echo $currentMessages['message'] ?></p>

          <form action="contacts.php" method="POST">

            <!-- getting the id of the message -->
            <input type="hidden" name="id" value="<?php echo $currentMessages['id'] ?>">

            <input type="submit" name="delete" class="delete-button" onclick="return confirm('Are You Sure?')" value="سڕینەوە">
            <?php
            if ($currentMessages['state'] == 'unread') { ?>
              <input type="submit" name="read" class="read-message-button" value="خوێندنەوە">
            <?php
              echo '<i class="fa fa-circle" style="color: red;"></i>';
            } else if ($currentMessages['state'] == 'read') {
              echo '<i class="fa fa-circle" style="color: green;"></i>';
            }
            ?>
          </form>

        </div>
    <?php
      }
    } else {
      $message[] = 'هیچ پەیامێک نییە.';
    };
    ?>

  </div>





  <!-- font awesome link-->
  <script src="https://kit.fontawesome.com/5dfe359bb3.js" crossorigin="anonymous"></script>
  <!-- jquery cdn link-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- custom js link-->
  <script>
    var userType = <?php echo json_encode($userType); ?>;
  </script>
  <script src="../js/scripts.js"></script>

</body>

</html>