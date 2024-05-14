<?php
require_once 'config.php';
session_start();

$userType = $_SESSION['user_type'] ?? null;

$isAdmin = fn ($userType) => $userType === 'admin';


function generateHref($row, $isAdmin)
{
  return !$isAdmin ? "{$row['type']}_details.php?id={$row['id']}" : "../{$row['type']}_details.php?id={$row['id']}";
}


if (isset($_POST['search_query'])) {
  $search_query = $_POST['search_query'];

  $query = "(SELECT name, id, 'book' as type FROM books WHERE name LIKE '%$search_query%')
            UNION
            (SELECT name, id, 'author' as type FROM authors WHERE name LIKE '%$search_query%');";
  $result = mysqli_query($conn, $query);

  $html = '';

  if (mysqli_num_rows($result) > 0) {
    $currentType = null;
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['type'] != $currentType) {
        $currentType = $row['type'];
        $title = $currentType == 'book' ? 'کتێبەکان' : 'نووسەرەکان';
        $html .= "<p class='search-result-title'>$title</p>";
      }
      $href = generateHref($row, $isAdmin($userType));
      $html .= <<<SEARCH_RESULT
        <a href="$href">
          <div class="search-result">
            {$row['name']}
          </div>
        </a>
      SEARCH_RESULT;
    }
  } else {
    $html .= <<<SEARCH_RESULT
      <div class="search-result">
        <p class="no-result">هیچ ئەنجامێک نەدۆرزایەوە.</p>
      </div>
    SEARCH_RESULT;
  }

  echo $html;
}

mysqli_close($conn);
