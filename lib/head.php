<?php
  include_once("prelude.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="/css/header_footer.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap">

    <?php
      if (isset($PAGE_HEAD)) {
        echo $PAGE_HEAD;
      }
    ?>

    <title><?php echo $PAGE_NAME; ?></title>
  </head>

  <body>
    <header>
      <div id="div_logo">
        <a href="/"><img src="../images/logo.png" alt="logo" id="logo" /></a>
      </div>

      <form method="get" action="/follow_page.php" id="recherche">
        <label for="pseudo">Recherche:</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="ex: solo" size="30" maxlength="10" />
      </form>

      <div id="account-login">
        <!-- TODO: clean that up? -->
        <?php if ($current_user == NULL) { ?>
          <a href="/user_login.php" class="login">Sign In</a>
        <?php } else { ?>
          <a href="/user_logout.php" class="logout">Hello, <?php echo $current_user->username; ?>.<br />Log out?</a>
        <?php } ?>
      </div>

    </header>
    <div id="main-horizontal">
      <nav class="sidebar">
        <ul>
          <li>test nav</li>
          <li>test nav deux</li>
        </ul>
      </nav>
      <main>
