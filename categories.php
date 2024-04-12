<select name="category" id="category">
    <?php
    $categories = ['roman','shi3r','dastan'];

    foreach ($categories as $category) {
        echo "<option value='$category'>$category</option>";
    }


    ?>
</select>