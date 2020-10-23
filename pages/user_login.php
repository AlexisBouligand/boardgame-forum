<?php
$PAGE_NAME = "Connexion";
// $PAGE_HEAD = "<link rel=\"stylesheet\" href=\"../css/user_login.css\" />";
include_once("../lib/head.php");

if (isset($_POST["submit"])) {
  // Handle login attempt
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

<?php
include_once("../lib/tail.php");
?>
