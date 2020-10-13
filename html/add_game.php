<?php
$PAGE_NAME = "Add Game";
include_once("../lib/head.php");
?>

<h2>Add a Game</h2>

<form class="main-form" method="post" action="fictif.php">
  <div class="text-input">
    <label for="pseudo">Game's name :</label>
    <input type="text" name="name" id="name" required/>
  </div>

  <div class="text-input">
    <label for="email">Creator : </label>
    <input type="text" name="creator" id="creator" required/>
  </div>

  <div class="text-input">
    <label for="price">Price : </label>
    <input type="text" name="price" id="price" required/>
  </div>

  <!-- TODO: this -->
  <!-- <input type="submit" name="image_button" value="Game's picture"> -->

  <input type="submit" name="send_button" value="Send">
</form>

<?php
  include_once("../lib/tail.php");
?>
