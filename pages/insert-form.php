<?php
$title = 'Add New Shikagami';
$nav_form_class = 'active_page';

define("MAX_FILE_SIZE", 1000000);

$upload_feedback = array(
  'general_error' => False,
  'too_large' => False
);

// query data
$result = exec_sql_query($db, 'SELECT * FROM entry;');
$records = $result->fetchAll();
$tags = exec_sql_query($db,
            "SELECT * FROM tags ;")->fetchAll();

// form validation and sticky value
$show_form = True;
$show_confirmation = False;
$form_feedback_show = array(
    'name' => False,
    'atk' => False,
    'hp' => False,
    'def' => False,
    'spd' => False,
    'rating' => False,
);

$form_values = array(
    'name' => '',
    'atk' => '',
    'hp' => '',
    'def' => '',
    'spd' => '',
    'rating' => '',
    'file_name' => '',
    'file_ext' => '',
    'source' => '',
);

$sticky_values = array(
    'name' => '',
    'atk' => '',
    'hp' => '',
    'def' => '',
    'spd' => '',
    'rating' => '',
    'source' => '',
);

if (isset($_POST['add-shikagami'])) {
  $form_values['name'] = trim($_POST['name']);
  $form_values['atk'] = trim($_POST['atk']);
  $form_values['hp'] = trim($_POST['hp']);
  $form_values['def'] = trim($_POST['def']);
  $form_values['spd'] = trim($_POST['spd']);
  $form_values['rating'] = trim($_POST['rating']);
  $form_values['source'] = trim($_POST['source']);
  if (empty($form_values['source'])) {
    $form_values['source'] = 'NULL';
  }

  $upload = $_FILES['png-file'];

  $form_valid = True;

  if ($upload['error'] == UPLOAD_ERR_OK) {
    $form_values['file_name'] = basename($upload['name']);
    $form_values['file_ext'] = strtolower(pathinfo($form_values['file_name'], PATHINFO_EXTENSION));
    // This site only accepts png files
    if (!in_array($form_values['file_ext'], array('png'))) {
      $form_valid = False;
      $upload_feedback['general_error'] = True;
    }
  } else if (($upload['error'] == UPLOAD_ERR_INI_SIZE) || ($upload['error'] == UPLOAD_ERR_FORM_SIZE)) {
    // file was too big, let's try again
    $form_valid = False;
    $upload_feedback['too_large'] = True;
  } else {
    // upload was not successful
    $form_valid = False;
    $upload_feedback['general_error'] = True;
  }


  if ($form_values['name'] == '') {
    $form_valid = False;
    $form_feedback_show['name'] = True;
  }
  if ($form_values['atk'] == '') {
    $form_valid = False;
    $form_feedback_show['atk'] = True;
  }
  if ($form_values['hp'] == '') {
    $form_valid = False;
    $form_feedback_show['hp'] = True;
  }
  if ($form_values['def'] == '') {
    $form_valid = False;
    $form_feedback_show['def'] = True;
  }
  if ($form_values['spd'] == '') {
    $form_valid = False;
    $form_feedback_show['spd'] = True;
  }
  if ($form_values['rating'] == '') {
    $form_valid = False;
    $form_feedback_show['rating'] = True;
  }

  if ($form_valid) {
    $result = exec_sql_query(
      $db,
      "INSERT INTO entry (name, atk, hp, def, spd, rating, file_name, file_ext, source) VALUES (:name, :atk, :hp, :def, :spd, :rating,  :file_name, :file_ext, :source);",
      array(
        ':name' => $form_values['name'], // tainted
        ':atk' => $form_values['atk'], // tainted
        ':hp' => $form_values['hp'], // tainted
        ':def' => $form_values['def'], // tainted
        ':spd' => $form_values['spd'], // tainted
        ':rating' => $form_values['rating'], // tainted
        ':file_name' => $form_values['file_name'], // tainted
        ':file_ext' => $form_values['file_ext'], // tainted
        ':source' => $form_values['source'], // tainted
      )
    );
    $show_form = False;
    $show_confirmation = True;
  } else {
    $sticky_values['name'] = $form_values['name'];
    $sticky_values['atk'] = $form_values['atk'];
    $sticky_values['hp'] = $form_values['hp'];
    $sticky_values['def'] = $form_values['def'];
    $sticky_values['spd'] = $form_values['spd'];
    $sticky_values['rating'] = $form_values['rating'];
    $sticky_values['source'] = $form_values['source'];
  }
  if ($result) {
    $record_id = $db->lastInsertId('id');
    $upload_storage_path = 'public/uploads/entry/' . $record_id . '.' . $form_values['file_ext'];
    // Move the file to the public/uploads/entry folder
    // Note: THIS FUNCTION REQUIRES A PATH. NOT A URL!
    if (move_uploaded_file($upload["tmp_name"], $upload_storage_path) == False) {
      error_log("Failed to permanently store the uploaded file on the file server. Please check that the server folder exists.");
    }
    $checked_tags = $_POST['tag_form'];
    foreach ($checked_tags as $tag_id) {
      $tag_result = exec_sql_query(
        $db,
        "INSERT INTO entry_tags(shikimagi_id, tag_id) VALUES ($record_id, $tag_id);"
      );
    }
  }
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

  <main>
    <div id="shikagami-form">
      <?php if ($show_form) { ?>
      <section>
        <form method="post" action="/form" enctype="multipart/form-data">

          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>">

          <div class="label-input">
            <label for="name_field">Name: </label>
            <?php if ($form_feedback_show['name']) { ?>
              <p class="feedback"> Please provide the shikagami's name.</p>
            <?php } ?>
            <input id="name_field" type="text" name="name" value="<?php echo $sticky_values['name']; ?>">
          </div>

          <div class="label-input">
            <label for="atk_field">ATK: </label>
            <?php if ($form_feedback_show['atk']) { ?>
              <p class="feedback"> Please provide the shikagami's ATK value.</p>
            <?php } ?>
            <input id="atk_field" type="number" name="atk" value="<?php echo $sticky_values['atk']; ?>">
          </div>

          <div class="label-input">
            <label for="hp_field">HP: </label>
            <?php if ($form_feedback_show['athpk']) { ?>
              <p class="feedback"> Please provide the shikagami's HP value.</p>
            <?php } ?>
            <input id="hp_field" type="number" name="hp" value="<?php echo $sticky_values['hp']; ?>">
          </div>

          <div class="label-input">
            <label for="def_field">DEF: </label>
            <?php if ($form_feedback_show['def']) { ?>
              <p class="feedback"> Please provide the shikagami's DEF value.</p>
            <?php } ?>
            <input id="def_field" type="number" name="def" value="<?php echo $sticky_values['def']; ?>">
          </div>

          <div class="label-input">
            <label for="spd_field">SPD: </label>
            <?php if ($form_feedback_show['spd']) { ?>
              <p class="feedback"> Please provide the shikagami's SPD value.</p>
            <?php } ?>
            <input id="spd_field" type="number" name="spd" value="<?php echo $sticky_values['spd']; ?>">
          </div>

          <div class="label-input">
            <label for="rating_field">Rating: </label>
            <?php if ($form_feedback_show['rating']) { ?>
              <p class="feedback"> Please provide the shikagami's rating.</p>
            <?php } ?>
            <input id="rating_field" type="text" name="rating" value="<?php echo $sticky_values['rating']; ?>">
          </div>

          <div class="label-input">
            <label for="upload-file">Image (PNG File):</label>
            <?php if ($upload_feedback['too_large']) { ?>
              <p class="feedback">We're sorry. The file failed to upload because it was too big. Please select a file that&apos;s no larger than 1MB.</p>
            <?php } ?>
            <?php if ($upload_feedback['general_error']) { ?>
              <p class="feedback">We're sorry. Something went wrong. Please select an PNG file to upload.</p>
            <?php } ?>
            <!-- This site only accepts PNG files! -->
            <input id="upload-file" type="file" name="png-file" accept=".png,image/png+xml">
          </div>

          <div class="label-input">
            <label for="upload-source" class="optional">Source URL:</label>
            <input id='upload-source' type="url" name="source" value="<?php echo $sticky_values['source']; ?>" placeholder="URL where found. (optional)">
          </div>

          <div id="tag-inputs">
            <label id="tag-label">Tags: </label>
            <?php
            foreach ($tags as $tag) { ?>
              <div class="each-tags">
                <input type="checkbox"
                      name="tag_form[]"
                      id="form-<?php echo htmlspecialchars($tag['tag_name']); ?>"
                      value="<?php echo htmlspecialchars($tag['id']); ?>"/>
                <label for="form-<?php echo $tag['tag_name']; ?>"><?php echo htmlspecialchars($tag['tag_name']); ?></label>
              </div>
            <?php } ?>
          </div>

          <div class="align-right">
            <input class="button" type="submit" value="Submit" name='add-shikagami'>
          </div>
        </form>
      </section>
      <?php } ?>

      <?php if ($show_confirmation) { ?>
        <div id="confirm-message">
          <h2>New Shikagami added successfully! </h2>
          <a class="button add-another" href="/form">Add Another Shikagami</a>
        </div>
      <?php } ?>
    </div>
  </main>
    <?php include('includes/footer.php'); ?>
</body>

</html>
