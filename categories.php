<?php
$categories = ['ڕۆمان', 'شیعر', 'چیرۆک', 'سیاسی', 'زانست', 'ئاینی'];
?>

<select name="category" id="category" class="field">
    <?php

    foreach ($categories as $category) {
        echo "<option value='$category'>$category</option>";
    }

    ?>
</select>