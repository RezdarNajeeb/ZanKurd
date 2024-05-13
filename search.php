<?php
require_once 'config.php';

if (isset($_POST['search_query'])) {
    $search_query = $_POST['search_query'];

    // Perform a search query based on the entered characters
    $query = "SELECT * FROM books WHERE name LIKE '$search_query%';";
    $result = mysqli_query($conn, $query);

    // Display the search results
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>" . $row['name'] . "</p>";
        }
    } else {
        echo "<p>No results found</p>";
    }
}

mysqli_close($conn);
?>
