<select name="category" id="category">
    <?php
    $categories = ['ڕۆمان', 'شیعر', 'داستان', 'سیاسی', 'زانست', 'هونەر'];

    foreach ($categories as $category) {
        echo "<option value='$category'>$category</option>";
    }

    ?>
</select>