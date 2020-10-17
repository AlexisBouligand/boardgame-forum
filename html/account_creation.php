<?php
$PAGE_NAME = "Create Account";
include_once("../lib/head.php");
?>

<h2>Account creation</h2>

<form class="main-form" method="post" action="fictif.php">
  <div class="text-input">
    <label for="pseudo">Pseudo:</label>
    <input type="text" name="pseudo" id="pseudo" required />
  </div>

  <div class="text-input">
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" required />
  </div>

  <div class="text-input">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required />
  </div>

  <div class="text-input">
    <label for="Birthdate">Birthdate:</label>
    <input type="text" name="Birthdate" id="Birthdate" required />
  </div>

  <div class="dropdown-menu">
    Country:
    <select name="country" id="country-select">
      <option name="AL">Albanie</option>
      <option name="FR" selected>France</option>
      <option name="WK">Wakanda</option>
    </select>
  </div>

  <!-- TODO: this -->
  <!-- <input type="submit" name="pp_button" value="chose profile picture"> -->

  <input type="submit" name="send_button" value="Send">
</form>

<?php
include_once("../lib/tail.php");
?>
