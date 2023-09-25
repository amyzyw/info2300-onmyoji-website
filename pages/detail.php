<?php

// Get the record using the `id` from the DB.
$record_id = ($_GET['record'] == '' ? NULL : (int)$_GET['record']);

$record = NULL;
if ($record_id != NULL) {

  $records = exec_sql_query(
    $db,
    "SELECT * FROM entry_tags INNER JOIN entry ON (entry_tags.shikimagi_id = entry.id) WHERE (entry.id = $record_id);"
  )->fetchAll();

  $records_tag = exec_sql_query(
    $db,
    "SELECT tags.tag_name AS 'tags' FROM entry_tags INNER JOIN entry ON (entry_tags.shikimagi_id = entry.id) INNER JOIN tags ON (entry_tags.tag_id = tags.id) WHERE (entry.id = $record_id);"
  )->fetchAll();

  $record_tag = array();
  // Did we find the record?
  if (count($records) > 0) {
    $record = $records[0]; // first record
    foreach ($records_tag as $tag_record) {
      array_push($record_tag, $tag_record['tags']);
    }
  }
}
$title = $record['name']
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title; ?></title>

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">
</head>

<body>
  <?php include('includes/header.php'); ?>
  <main>
    <div class="entry">
      <div class="shikagami-img">
        <?php $file_url = '/public/uploads/entry/' . $record_id . '.' . $record['file_ext']; ?>
          <div class="image-source">
              <img src="<?php echo htmlspecialchars($file_url); ?>" alt="<?php echo htmlspecialchars($record['file_name']); ?>">
                <a class="source" href="<?php echo htmlspecialchars($record['source']) ?>">
                  <?php echo htmlspecialchars($record['source']) ?>
                </a>
                <h3 id="detail-rating">Rating: <?php echo htmlspecialchars($record['rating']); ?></h3>
          </div>
      </div>
      <div class="entry-data">
        <h3><?php echo htmlspecialchars($record['name']); ?></h3>
        <h4><?php foreach ($record_tag as $tag) echo htmlspecialchars($tag) . ' ' ; ?></h4>
        <p>ATK: <?php echo htmlspecialchars($record['atk']); ?></p>
        <p>HP: <?php echo htmlspecialchars($record['hp']); ?></p>
        <p>DEF: <?php echo htmlspecialchars($record['def']); ?></p>
        <p>SPD: <?php echo htmlspecialchars($record['spd']); ?></p>
        <div class="align-right">
          <a class="button" href="/">Back to Catalog</a>
        </div>
      </div>
    </div>
  </main>
  <?php include('includes/footer.php'); ?>
</body>
