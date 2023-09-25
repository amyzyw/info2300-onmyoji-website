<header>
    <nav>
      <ul>
        <li class="<?php echo $nav_home_class; ?>"><a href="/">HOME</a></li>
        <?php if (is_user_logged_in()) { ?>
          <li class="<?php echo $nav_form_class; ?>"><a href="/form">INSERT</a></li>
          <li class="log"><a href="<?php echo logout_url(); ?>">Logout</a></li>
        <?php } ?>
        <?php if (!is_user_logged_in()) { ?>
          <li class="log <?php echo $nav_login_class; ?>"><a href="/login">Login</a></li>
        <?php } ?>
      </ul>
    </nav>
    <h1 id="title"><?php echo htmlspecialchars($title); ?></h1>
    <img id="logo" src="/public/img/logo.png" alt="logo">
    <div class="cite">
      Source: <cite><a href="https://www.steamgriddb.com/game/15037">SteamGirdDB</a></cite>
      <!--Source: SteamGridDB https://www.steamgriddb.com/game/15037 by NetEase Games-->
    </div>
</header>
