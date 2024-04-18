<?php $categories = ['ڕۆمان', 'شیعر', 'چیرۆک', 'سیاسی', 'زانست', 'هونەر']; ?>

<select name="category" id="category">
    <?php

    foreach ($categories as $category) {
        echo "<option value='$category'>$category</option>";
    }

    ?>
</select>