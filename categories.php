<?php $categories = ['ڕۆمان', 'شیعر', 'چیرۆک', 'سیاسی', 'زانست', 'ئاینی']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<select name="category" id="category" class="field">
    <?php

    foreach ($categories as $category) {
        echo "<option value='$category'>$category</option>";
    }

    ?>
</select>