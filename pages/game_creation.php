<?php
$PAGE_NAME = "Add Game";
include_once("../lib/head.php");
?>

<h2>Add a Game</h2>

<form class="main-form" method="post" action="../lib/add_game.php">

    <label>Game's name :
    <input type="text" name="name" required/>
    </label>

    <label>Creator :
    <input type="text" name="creator" required/>
    </label>

    <label>Publisher :
    <input type="text" name="publisher" required/>
    </label>

    <label>Price :
    <input type="number" name="price" required/>
    </label>

  <!-- TODO: this -->
  <!-- <input type="submit" name="image_button" value="Game's picture"> -->

  <input type="submit" name="send_button" value="Send">
</form>

<?php
include_once("../lib/tail.php");
?>
