<?php
$PAGE_NAME = "Connexion";
$PAGE_HEAD = "<script src=\"/js/user_login.js\" defer></script>";
include_once("../lib/head.php");

if (isset($_POST["submit"])) {
  $pseudonym = $_POST["pseudo"];
  $password = $_POST["password"];

  if (preg_match(PSEUDO_REGEX, $pseudonym) && preg_match(PASSWORD_REGEX, $password)) {
    if (try_login($pseudonym, $password)) {
      $_SESSION["pseudonym"] = $pseudonym;
      $_SESSION["password"] = $password;
      header("Location: /user.php?username=$current_user->username");
    } else {
      echo "Login attempt failed: try again!";
    }
  } else {
    echo "Invalid form details entered!";
  }
}
?>

<form class="main-form" method="post" action="user_login.php">
  <label>Pseudo:
    <input type="text" name="pseudo" required id="pseudo" />
  </label>

  <label>Password:
    <input type="password" name="password" required id="password" />
  </label>

  <input type="submit" name="submit" value="Send" id="submit">
</form>

<a href="/account_creation.php" class="center gray">Sign up</a>

<?php
include_once("../lib/tail.php");
?>
