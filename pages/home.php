<?php

$title = 'Shikigami Catalog';
$nav_home_class = 'active_page';

$result = exec_sql_query($db,
            "SELECT entry.id AS entry_id, entry.* FROM entry ;");

$result_tag = exec_sql_query($db,
            "SELECT * FROM tags ;");

$tags = $result_tag->fetchAll();

// Did the user submit the form?
if (!empty($_GET)) {
  // Get HTTP request user data
    $filter_result = exec_sql_query($db,
          "SELECT entry.id AS entry_id, entry_tags.id AS entry_tag_id, entry.*
          FROM entry
          LEFT OUTER JOIN entry_tags ON (entry_tags.shikimagi_id = entry.id)
          WHERE (entry_tags.tag_id = :tag_id);",
          array(':tag_id' => $_GET['tag_id'])
  );
  $records = $filter_result->fetchAll();
} else {
  $records = $result->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title><?php echo $title; ?></title>

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">

</head>

<body>
  <?php include('includes/header.php'); ?>

  <main id="all-entry-page">
    <div id="table-div">
      <table>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>ATK</th>
          <th>HP</th>
          <th>Rating</th>
        </tr>
        <?php foreach ($records as $record) { ?>
          <tr>
            <td class="td-image">
              <?php $file_url = '/public/uploads/entry/' . $record['entry_id'] . '.' . $record['file_ext']; ?>
              <div class="image-source">
                <img class="home-image" src="<?php echo htmlspecialchars($file_url); ?>" alt="<?php echo htmlspecialchars($record['file_name']); ?>">
                <a class="source" href="<?php echo htmlspecialchars($record['source']) ?>">
                  <?php echo htmlspecialchars($record['source']) ?>
                </a>
              </div>
            </td>
            <td class="text-col"><a href ="/detail?<?php echo http_build_query(array('record' => $record['entry_id'])) ?>"><?php echo htmlspecialchars($record['name']); ?></a></td>
            <td class="text-col"><?php echo htmlspecialchars($record['atk']); ?></td>
            <td class="text-col"><?php echo htmlspecialchars($record['hp']); ?></td>
            <td class="text-col"><?php echo htmlspecialchars($record['rating']); ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>

      <div id="filter-div">
        <h4>Apply Filter</h4>
        <form id="filter" action="/" method="get" novalidate>
          <?php
          foreach ($tags as $tag) { ?>
            <div class="filter-label">
              <input type="checkbox"
                      name="tag_id"
                      id="filter-<?php echo htmlspecialchars($tag['tag_name']); ?>"
                      value="<?php echo htmlspecialchars($tag['id']); ?>"/>
              <label for="filter-<?php echo $tag['tag_name']; ?>"><?php echo htmlspecialchars($tag['tag_name']); ?></label>
            </div>
          <?php } ?>
            <div id="filter-button">
              <button id="get-filter" class="button" type="submit">Search</button>
            </div>
        </form>
      </div>
  </main>
  <?php include('includes/footer.php'); ?>
</body>

</html>
