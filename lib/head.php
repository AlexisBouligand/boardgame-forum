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
    <script src="/js/main.js"></script>

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

      <form method="get" action="/list_games.php" id="recherche">
        <label for="name">Search for a game</label>
        <input type="text" name="name" placeholder="ex: solo" size="30" maxlength="10" />
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

          <li><a href="/" id="main_page_link">Main page</a></li>

          <li><a href="/list_games.php">Search game</a></li>
          <li><a href="/list_users.php">Search user</a></li>
            <li><a href="/game_creation.php">Add a game</a></li>

            <!--If the user is connected, he/she can see his followers and profile page-->
          <?php if ($current_user != NULL) { ?>
            <li><a href="/user.php?id=<?php echo $current_user->id; ?>">Profile page</a></li>
            <li><a href="/list_users.php?following=">Following</a></li>
            <li><a href="/list_users.php?followers=">Followers</a></li>
          <?php }else{?><!-- the user can only create an account if he/she is not already connected-->
            <li><a href="/account_creation.php"</li>Create account</a></li>
            <?php }?>

        </ul>
      </nav>

      <main>
