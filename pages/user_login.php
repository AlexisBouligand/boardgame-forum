<?php
$PAGE_NAME = "Connexion";
// $PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/user_login.css\" />";
include_once("../lib/head.php");

if (isset($_POST["submit"])) {
  // TODO: sanitize and verify
  $pseudonym = $_POST["pseudo"];
  $password = $_POST["password"];

  if (try_login($pseudonym, $password)) {
    $_SESSION["pseudonym"] = $pseudonym;
    $_SESSION["password"] = $password;
    header("Location: /");
  } else {
    echo "Login attempt failed: try again!";
  }
}
?>

<form class="main-form" method="post" action="user_login.php">
  <label >Pseudo:
    <input type="text" name="pseudo" required/>
  </label>


  <label>Password:
    <input type="password" name="password" required/>
  </label>

  <input type="submit" name="submit" value="Send">
</form>

<a href="/account_creation.php" class="center gray">Sign up</a>

<?php
include_once("../lib/tail.php");
?>
