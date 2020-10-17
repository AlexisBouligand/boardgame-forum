<?php
$PAGE_NAME = "Connexion";
// $PAGE_HEAD = "<link rel=\"stylesheet\" href=\"../css/user_login.css\" />";
include_once("../lib/head.php");

if (isset($_POST["submit"])) {
  // Handle login attempt
}
?>

<form class="main-form" method="post" action="user_login.php">

  <div class="text-input">
    <label for="pseudo">Pseudo:</label>
    <input type="text" name="pseudo" id="pseudo" required/>
  </div>

  <div class="text-input">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required/>
  </div>

  <input type="submit" name="submit" value="Send">
</form>

<?php
include_once("../lib/tail.php");
?>
