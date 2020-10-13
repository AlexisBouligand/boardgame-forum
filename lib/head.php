<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../css/header_footer.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap">

    <title><?php echo $PAGE_NAME; ?></title>
  </head>

  <body>
    <header>
      <div id="div_logo">
        <a href="main_page.php"><img src="../images/logo.png" alt="logo" id="logo" /></a>
      </div>

      <form method="post" action="traitement.php" id="recherche">
        <label for="pseudo">Recherche:</label>
        <input type="text" name="pseudo" id="pseudo" placeholder="ex : solo" size="30" maxlength="10" />
      </form>

      <div id="account-login">
        <!-- TODO: clean that up? -->
        <a href="user_connexion.php" class="login">Sign In</a>
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
