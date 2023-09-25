<?php
$title = 'Admin Login';
$nav_login_class = 'active_page';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Admin Login</title>

  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all">

</head>

<body>
<?php include('includes/header.php'); ?>
  <div id="login-form-box">
    <?php if (!is_user_logged_in()) { ?>
      <?php echo login_form('/login', $session_messages);
    } ?>
    <?php if (is_user_logged_in()) { ?>
      <h3 class="welcome">Welcome <strong><?php echo htmlspecialchars($current_user['name']); ?></strong>!</h3>
    <?php } ?>
  </div>
  <?php include('includes/footer.php'); ?>
</body>
